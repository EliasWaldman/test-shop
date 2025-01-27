<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_group',
      'name'
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
}
