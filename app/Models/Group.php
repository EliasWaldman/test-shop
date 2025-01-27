<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'id_parent'
    ];

    public function parent()
    {
        return $this->belongsTo(Group::class, 'id_parent');
    }

    public function children()
    {
        return $this->hasMany(Group::class, 'id_parent');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_group');
    }

}
