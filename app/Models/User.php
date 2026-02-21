<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'Users';
    protected $primaryKey = 'ID';
    public $timestamps = false; // We use explicit DateAdded/DateModified, not created_at/updated_at.

    protected $fillable = [
        'FullName', 'Username', 'Password', 'Role', 'Status', 'DateAdded', 'DateModified'
    ];

    protected $hidden = [
        'Password',
    ];

    // Using "getAuthPassword" override since our column is Password not password
    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function permissionsSets()
    {
        return $this->hasMany(PermissionsSet::class, 'UserID', 'ID');
    }

    public function audits()
    {
        return $this->hasMany(Audit::class, 'UserID', 'ID');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'UserID', 'ID');
    }

    public function spoilages()
    {
        return $this->hasMany(Spoilage::class, 'UserID', 'ID');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'UserID', 'ID');
    }

    public function productionBatches()
    {
        return $this->hasMany(ProductionBatch::class, 'UserID', 'ID');
    }
}