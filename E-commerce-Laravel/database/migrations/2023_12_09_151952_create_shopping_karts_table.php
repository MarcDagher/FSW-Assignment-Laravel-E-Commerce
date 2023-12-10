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
        Schema::create('shopping_kart', function (Blueprint $shopping_kart){
            $shopping_kart -> integer('product_id');
            $shopping_kart -> integer('user_id');
            $shopping_kart -> string('status'); // pending - done
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
