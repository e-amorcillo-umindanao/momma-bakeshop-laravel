<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    protected $table = 'SoldProducts';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'SalesID', 'ProductID', 'Quantity', 'SubAmount', 'DateAdded'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'SalesID', 'ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ID');
    }
}