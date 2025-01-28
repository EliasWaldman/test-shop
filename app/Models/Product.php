<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_group',
      'name',
      'description'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'id_product');
    }

    public function getLattestPriceAttribute()
    {
        return $this->prices()->latest()->first();
    }


    public function scopeSorted(Builder $query)
    {
        $sort = request('sort');

        if ($sort === 'price') {
            $query->join('prices', 'products.id', '=', 'prices.id_product')
                ->orderBy('prices.price', 'ASC');
        } elseif ($sort === '-price') {
            $query->join('prices', 'products.id', '=', 'prices.id_product')
                ->orderBy('prices.price', 'DESC');
        } elseif ($sort === 'name') {
            $query->orderBy('products.name', 'ASC');
        } elseif ($sort === '-name') {
            $query->orderBy('products.name', 'DESC');
        }
    }

}
