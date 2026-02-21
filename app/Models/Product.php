<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Products';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ProductName', 'ProductDescription', 'CategoryID', 'Price', 
        'Quantity', 'LowStockThreshold', 'DateAdded', 'DateModified'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'ID');
    }

    public function soldProducts()
    {
        return $this->hasMany(SoldProduct::class, 'ProductID', 'ID');
    }

    public function spoiledProducts()
    {
        return $this->hasMany(SpoiledProduct::class, 'ProductID', 'ID');
    }

    public function productionBatches()
    {
        return $this->hasMany(ProductionBatch::class, 'ProductID', 'ID');
    }
}