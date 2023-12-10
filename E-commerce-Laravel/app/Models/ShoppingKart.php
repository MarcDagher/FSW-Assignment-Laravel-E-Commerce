<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingKart extends Model
{
    use HasFactory;

    protected $table = 'shopping_kart';

    public function user(){
        return $this -> belongsTo(User::class, 'user_id', 'users_id');
    }

    public function product(){
        return $this -> belongsTo(Product::class, 'product_id', 'product_id');
    }

}