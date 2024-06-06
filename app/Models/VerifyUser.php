<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'expire_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}