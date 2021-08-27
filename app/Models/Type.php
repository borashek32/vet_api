<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_type'
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'type_user', 'type_id', 'user_id');
    }
}
