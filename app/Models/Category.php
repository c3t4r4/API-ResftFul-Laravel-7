<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    /** Relationships */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    /** Scopes */
    public function scopeGetResults($query, $name = null, $total = 10)
    {
        if(!empty($name)){
            return $query->where('name', 'LIKE', "%{$name}%")->paginate($total);
        }

        return $query->get();
    }

    /** Attributes */

    /** Functions */
}
