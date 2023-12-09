<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('products', function (Blueprint $product) {
        $product -> id('product_id');
        $product -> string('product_name');
        $product -> string('description');
        $product -> integer('price');
        $product -> integer('stock');
        $product -> integer('user_id');
      });   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
