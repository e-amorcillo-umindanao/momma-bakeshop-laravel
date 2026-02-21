<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SoldProduct;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    private function logAudit($tableEdited, $action, $previousChanges, $savedChanges)
    {
        Audit::create([
            'UserID' => Auth::id(),
            'TableEdited' => $tableEdited,
            'PreviousChanges' => $previousChanges ? json_encode($previousChanges) : null,
            'SavedChanges' => $savedChanges ? json_encode($savedChanges) : null,
            'Action' => $action,
            'DateAdded' => now(),
        ]);
    }

    public function index()
    {
        // Only fetch products that have stock > 0
        $products = Product::where('Quantity', '>', 0)->get();
        return view('pos.index', compact('products'));
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'cart' => 'required|string', // JSON string from frontend
            'transaction_type' => 'required|in:Walk-in,B2B',
            'amount_tendered' => 'required|numeric|min:0',
        ]);

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

            if ($validated['amount_tendered'] < $totalAmount) {
                throw new \Exception("Amount tendered is less than the total amount due.");
            }

            $change = $validated['amount_tendered'] - $totalAmount;

            // 1. Create the Sale Record
            $sale = Sale::create([
                'UserID' => Auth::id(),
                'B2BClientID' => null, // Handle B2B specifically later if needed
                'TransactionType' => $validated['transaction_type'],
                'TotalAmount' => $totalAmount,
                'AmountTendered' => $validated['amount_tendered'],
                'Change' => $change,
                'PaymentStatus' => 'Paid',
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
                    'SaleID' => $sale->ID,
                    'ProductID' => $product->ID,
                    'Quantity' => $item['quantity'],
                    'Subtotal' => $product->Price * $item['quantity'],
                    'DateAdded' => now(),
                ]);

                // Audit Product Update
                $this->logAudit('Products', 'UPDATE', $previousProductState, $product->toArray());
            }

            // Audit Sale Creation
            $this->logAudit('Sales', 'INSERT', null, $sale->toArray());

            DB::commit();

            return redirect()->route('pos.index')->with('success', "Sale successful! Change: ₱" . number_format($change, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}