<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $table = 'StockMovements';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'InventoryID', 'UserID', 'MovementType', 'Quantity', 'Supplier', 'DateAdded'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'InventoryID', 'ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'ID');
    }
}