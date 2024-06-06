<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public static function getCategories()
    {
        return DB::table('categories')->get();
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}