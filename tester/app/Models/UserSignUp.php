<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersSignUp extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'email',
        'password', 
        'role_id', 
    ];
}
