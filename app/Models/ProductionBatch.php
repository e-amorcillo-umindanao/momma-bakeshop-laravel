<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionBatch extends Model
{
    protected $table = 'ProductionBatches';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ProductID', 'UserID', 'QuantityProduced', 'ProductionDate', 'DateAdded'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'ID');
    }

    public function spoiledProducts()
    {
        return $this->hasMany(SpoiledProduct::class, 'BatchID', 'ID');
    }
}