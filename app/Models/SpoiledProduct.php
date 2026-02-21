<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpoiledProduct extends Model
{
    protected $table = 'SpoiledProducts';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'SpoilageID', 'ProductID', 'BatchID', 'Quantity', 'SubAmount', 'Reason', 'DateAdded'
    ];

    public function spoilage()
    {
        return $this->belongsTo(Spoilage::class, 'SpoilageID', 'ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ID');
    }

    public function batch()
    {
        return $this->belongsTo(ProductionBatch::class, 'BatchID', 'ID');
    }
}