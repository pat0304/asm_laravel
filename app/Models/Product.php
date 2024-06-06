<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'sale', 'category_id', 'image', 'warehouse'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}