<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SoldProduct;
use App\Traits\HasAuditLogging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    use HasAuditLogging;

    public function index()
    {
        // Only fetch products that have stock > 0
        $products = Product::where('Quantity', '>', 0)->get();
        return view('pos.index', compact('products'));
    }

    public function checkout(Request $request)
    {
        $rules = [
            'cart' => 'required|string', // JSON string from frontend
            'transaction_type' => 'required|in:Walk-in,B2B',
        ];

        // Only require amount_tendered for Walk-in transactions (Bug #7)
        if ($request->input('transaction_type') === 'Walk-in') {
            $rules['amount_tendered'] = 'required|numeric|min:0';
        } else {
            $rules['amount_tendered'] = 'nullable|numeric|min:0';
        }

        $validated = $request->validate($rules);

        $cart = json_decode($validated['cart'], true);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty!');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;

            // Calculate total and verify stock
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);
                if ($product->Quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->ProductName}. Available: {$product->Quantity}");
                }
                $totalAmount += ($product->Price * $item['quantity']);
            }

            $amountTendered = $validated['amount_tendered'] ?? 0;
            $isB2B = $validated['transaction_type'] === 'B2B';

            // For Walk-in, verify amount tendered covers total
            if (!$isB2B && $amountTendered < $totalAmount) {
                throw new \Exception("Amount tendered is less than the total amount due.");
            }

            $change = $isB2B ? 0 : ($amountTendered - $totalAmount);

            // 1. Create the Sale Record
            $sale = Sale::create([
                'UserID' => Auth::id(),
                'B2BClientID' => null, // Can be linked to a B2B client picker in the future
                'TransactionType' => $validated['transaction_type'],
                'TotalAmount' => $totalAmount,
                'AmountTendered' => $isB2B ? null : $amountTendered,
                'Change' => $isB2B ? null : $change,
                'PaymentStatus' => $isB2B ? 'Pending' : 'Paid',
                'DateAdded' => now(),
            ]);

            // 2. Process Sold Products and Deduct Inventory
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);
                $previousProductState = $product->toArray();

                // Deduct Inventory
                $product->Quantity -= $item['quantity'];
                $product->DateModified = now();
                $product->save();

                // Record Sold Product
                SoldProduct::create([
                    'SalesID' => $sale->ID,
                    'ProductID' => $product->ID,
                    'Quantity' => $item['quantity'],
                    'SubAmount' => $product->Price * $item['quantity'],
                    'DateAdded' => now(),
                ]);

                // Audit Product Update
                $this->logAudit('Products', 'UPDATE', $previousProductState, $product->toArray());
            }

            // Audit Sale Creation
            $this->logAudit('Sales', 'INSERT', null, $sale->toArray());

            DB::commit();

            $successMessage = $isB2B
                ? "B2B order recorded successfully! Total: ₱" . number_format($totalAmount, 2) . " (Payment Pending)"
                : "Sale successful! Change: ₱" . number_format($change, 2);

            return redirect()->route('pos.index')->with('success', $successMessage);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
