<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'type_user';

    protected $fillable = [
        'user_id',
        'type_id'
    ];
}
