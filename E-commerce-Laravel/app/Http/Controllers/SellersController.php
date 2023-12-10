<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellersController extends Controller
{
    // 'product_name','description', 'price', 'stock', 'user_id' (user_id should be available from he token)
    // function check_product ($req) {
    //     $product_name = DB::table('products')  -> where('product_name', $req -> product_name) -> value('product_name');
    //     return $product_name;
    // }
    
    function create_product (Request $req) {
        $product_name = Product::where('product_name', $req -> product_name) -> value('product_name');

        if ($product_name){
            echo "Product name already exists";
        } else {
            Product::insert([
             'product_name' => $req -> product_name,
             'description' => $req -> description,
             'price' => $req -> price,
             'stock' => $req -> stock,
             'user_id' => $req -> user_id,
            ]);
            echo $req -> product_name . "\n";
            echo $req -> description . "\n";
            echo $req -> price . "\n";
            echo $req -> stock . "\n";
            echo $req -> user_id . "\n";
            echo $req -> product_name . " added successfuly";
        }
    }


    function update_product(Request $req){
        $product = Product::where('product_id', $req -> product_id) -> first();

        if ($product){
            echo $product . "\n";
            $product->update([
                "product_name" => $req -> product_name ?? $product -> product_name,
                "description" => $req -> description ?? $product -> description,
                "price" => $req -> price ?? $product -> price,
                "stock" => $req -> stock ?? $product -> stock,
            ]);
            echo "product updated";
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found',
            ], 404);
        }
    }
}