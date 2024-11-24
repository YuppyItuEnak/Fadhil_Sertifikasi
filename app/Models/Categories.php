<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
    ];
    public function books() {
        return $this->belongsToMany(Books::class, 'book_categories',  'categories_id', 'book_id');
    }
}
