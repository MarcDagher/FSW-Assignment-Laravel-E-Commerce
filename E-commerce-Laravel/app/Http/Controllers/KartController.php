<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingKart;
use App\Models\User;
use Illuminate\Http\Request;

class KartController extends Controller
{

    // product_name
    public function add_to_kart(Request $req){
        // choose a name from the products table 
        $user_id = $req -> user_id; // should be received from the token
        
        $exists = Product::where('product_name', $req->product_name)->first();
        $product_name = Product::where('product_name', $req->product_name)->get()[0];
        // echo $product_name -> product_id;
        if ($exists){
            ShoppingKart::insert([
                'product_id' => $product_name -> product_id,
                'user_id' => $user_id,
                'status' => 'pending'
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'product added to your kart'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'product not found'
            ]);
        }
        // check if name exists in products
        // if yes check add to kart
    }


    public function remove_from_kart(Request $req){

        $product_id = Product::where('product_name', $req->product_name) -> value('product_id');
        // i am receiving the name but i want to check the id
        // so i need to join the product name 
        $exists = ShoppingKart::where('product_id', $product_id) -> first();
        echo $req->product_name;
        if ($exists){
            echo $exists;
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'product not your kart'
            ]);
        }
    }


    public function display_products(){
        $products = Product::all();
        $product_details = [];
        foreach($products as $product){
            $product_details[] =[
            'id' => $product -> product_id,
            'name' => $product -> product_name,
            'description' => $product -> description,
            'price' => $product -> price,
            'stock' => $product -> stock,
            'seller' => $product -> user_id,
            ];
        }
        return response()->json($product_details);
    }
}
