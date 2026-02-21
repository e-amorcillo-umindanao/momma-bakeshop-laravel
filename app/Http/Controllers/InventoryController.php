<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Traits\HasAuditLogging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    use HasAuditLogging;


    public function index()
    {
        $rawMaterials = Inventory::all();
        $finishedGoods = Product::all();

        // Check for Low Stock Alerts
        $lowStockRawMaterials = $rawMaterials->filter(function ($item) {
            return $item->Quantity <= $item->LowStockThreshold;
        });

        $lowStockProducts = $finishedGoods->filter(function ($item) {
            return $item->Quantity <= $item->LowStockThreshold;
        });

        return view('inventory.index', compact('rawMaterials', 'finishedGoods', 'lowStockRawMaterials', 'lowStockProducts'));
    }

    public function stockInForm()
    {
        $rawMaterials = Inventory::all();
        return view('inventory.stock_in', compact('rawMaterials'));
    }

    public function storeStockIn(Request $request)
    {
        $validated = $request->validate([
            'InventoryID' => 'required|exists:Inventory,ID',
            'Quantity' => 'required|integer|min:1',
            'Supplier' => 'nullable|string|max:255',
        ]);

        $inventory = Inventory::findOrFail($validated['InventoryID']);
        $previous = $inventory->toArray();

        // Update Inventory Quantity
        $inventory->Quantity += $validated['Quantity'];
        $inventory->DateModified = now();
        $inventory->save();

        // Record Stock Movement
        $movement = StockMovement::create([
            'InventoryID' => $inventory->ID,
            'UserID' => Auth::id(),
            'MovementType' => 'Stock-In',
            'Quantity' => $validated['Quantity'],
            'Supplier' => $validated['Supplier'] ?? null,
            'DateAdded' => now(),
        ]);

        // Log Audits
        $this->logAudit('Inventory', 'UPDATE', $previous, $inventory->toArray());
        $this->logAudit('StockMovements', 'INSERT', null, $movement->toArray());

        return redirect()->route('inventory.index')->with('success', 'Stock-In recorded successfully.');
    }

    public function stockOutForm()
    {
        $rawMaterials = Inventory::where('Quantity', '>', 0)->get();
        return view('inventory.stock_out', compact('rawMaterials'));
    }

    public function storeStockOut(Request $request)
    {
        $validated = $request->validate([
            'InventoryID' => 'required|exists:Inventory,ID',
            'Quantity' => 'required|integer|min:1',
        ]);

        $inventory = Inventory::findOrFail($validated['InventoryID']);

        if ($inventory->Quantity < $validated['Quantity']) {
            return back()->withErrors(['Quantity' => 'Insufficient stock based on the entered quantity.']);
        }

        $previous = $inventory->toArray();

        // Update Inventory Quantity
        $inventory->Quantity -= $validated['Quantity'];
        $inventory->DateModified = now();
        $inventory->save();

        // Record Stock Movement
        $movement = StockMovement::create([
            'InventoryID' => $inventory->ID,
            'UserID' => Auth::id(),
            'MovementType' => 'Stock-Out',
            'Quantity' => $validated['Quantity'],
            'Supplier' => null, // Stock-Out has no supplier
            'DateAdded' => now(),
        ]);

        // Log Audits
        $this->logAudit('Inventory', 'UPDATE', $previous, $inventory->toArray());
        $this->logAudit('StockMovements', 'INSERT', null, $movement->toArray());

        return redirect()->route('inventory.index')->with('success', 'Stock-Out recorded successfully.');
    }
}
