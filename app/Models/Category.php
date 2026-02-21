<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Category';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['CategoryName', 'Description', 'DateAdded', 'DateModified'];

    public function products()
    {
        return $this->hasMany(Product::class, 'CategoryID', 'ID');
    }
}