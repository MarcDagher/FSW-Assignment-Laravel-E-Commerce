<?php
namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellersController extends Controller
{
    // req: 'product_name','description', 'price', 'stock', 'user_id' (user_id should be available from he token)
    
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

            return response()->json([
            'product name' => $req -> product_name . "\n",
            'request' => $req -> description . "\n",
            'price' => $req -> price . "\n",
            'stock' => $req -> stock . "\n",
            'user id' => $req -> user_id . "\n",
            'status' => $req -> product_name . " added successfuly",
            ]);
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

    function delete_product(Request $req){
        $product = Product::find($req -> product_id);
        if ($product){
            $product -> delete();
            return response() -> json([
                "status" => "success",
                "messagde" => "product deleted successfully"
            ]);
        } else {
            return response() -> json([
                "status" => "failed",
                "message" => "product not found",
            ], 404);
        }
    }

    function read_my_products(Request $req){
        echo "hello from read";
        $exists = Product::where('user_id',$req->user_id)->first(); // return null if empty
        $products = Product::where('user_id',$req->user_id)->get(); // doesn't returb null if empty
        if ($exists){
            echo $products;
        } else {
            return response() -> json([
                "status" => "failed",
                "message" => "There are no products to display",
            ], 404);
        }
    }
}