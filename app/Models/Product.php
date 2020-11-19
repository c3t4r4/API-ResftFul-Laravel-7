<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id'
    ];

    public function scopeGetResults($query, $data = null, $total = 10)
    {
        if(empty($data['filter']) && empty($data['name']) && empty($data['description'])){
            return $query->paginate($total);
        }

        return $query->where(function ($row) use ($data) {
           if(!empty($data['filter'])){
               $filter = $data['filter'];
               $row->where('name', $data['filter']);
               $row->orWhere('description', 'LIKE', "%{$filter}%");
           }

            if(!empty($data['name'])){
                $row->where('name', $data['name']);
            }

            if(!empty($data['description'])){
                $description = $data['description'];
                $row->where('description', 'LIKE', "%{$description}%");
            }
        })->paginate($total);
    }
}
