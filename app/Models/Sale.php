<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'Sales';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'UserID', 'B2BClientID', 'TransactionType', 'TotalAmount', 
        'AmountTendered', 'Change', 'PaymentStatus', 'DateAdded'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'ID');
    }

    public function b2bClient()
    {
        return $this->belongsTo(B2BClient::class, 'B2BClientID', 'ID');
    }

    public function soldProducts()
    {
        return $this->hasMany(SoldProduct::class, 'SalesID', 'ID');
    }
}