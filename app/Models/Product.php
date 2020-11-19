<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function scopeGetResults($query, $name = null)
    {
        if(!empty($name)){
            return $query->where('name', 'LIKE', "%{$name}%")->get();
        }

        return $query->get();
    }
}
