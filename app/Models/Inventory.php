<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'Inventory';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ItemName', 'ItemDescription', 'Measurement', 'Quantity', 
        'LowStockThreshold', 'DateAdded', 'DateModified'
    ];

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'InventoryID', 'ID');
    }
}