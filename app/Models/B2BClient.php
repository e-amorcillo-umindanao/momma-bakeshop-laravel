<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B2BClient extends Model
{
    protected $table = 'B2BClients';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ClientName', 'ContactDetails', 'DeliveryAddress', 'DateAdded', 'DateModified'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'B2BClientID', 'ID');
    }
}