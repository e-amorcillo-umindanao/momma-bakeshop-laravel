<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'Permissions';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['PermissionName', 'PermissionDesc'];

    public function permissionsSets()
    {
        return $this->hasMany(PermissionsSet::class, 'PermissionID', 'ID');
    }
}