<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spoilage extends Model
{
    protected $table = 'Spoilages';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['UserID', 'TotalAmount', 'DateAdded'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'ID');
    }

    public function spoiledProducts()
    {
        return $this->hasMany(SpoiledProduct::class, 'SpoilageID', 'ID');
    }
}