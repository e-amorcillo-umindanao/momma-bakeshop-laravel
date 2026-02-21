<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductionBatch;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductionBatchController extends Controller
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

    public function create()
    {
        $products = Product::all();
        return view('production.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ProductID' => 'required|exists:Products,ID',
            'QuantityProduced' => 'required|integer|min:1',
            'ProductionDate' => 'required|date',
        ]);

        // Generate the Production Batch record
        $batch = ProductionBatch::create([
            'ProductID' => $validated['ProductID'],
            'UserID' => Auth::id(),
            'QuantityProduced' => $validated['QuantityProduced'],
            'ProductionDate' => $validated['ProductionDate'],
            'DateAdded' => now(),
        ]);

        // Increase product inventory
        $product = Product::findOrFail($validated['ProductID']);
        $previous = $product->toArray();

        $product->Quantity += $validated['QuantityProduced'];
        $product->DateModified = now();
        $product->save();

        // Log Audits
        $this->logAudit('ProductionBatches', 'INSERT', null, $batch->toArray());
        $this->logAudit('Products', 'UPDATE', $previous, $product->toArray());

        return redirect()->route('inventory.index')->with('success', 'Production batch recorded successfully.');
    }
}
