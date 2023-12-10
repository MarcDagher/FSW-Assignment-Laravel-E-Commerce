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
        Schema::table('products', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('product_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('role_id');
        });

        Schema::table('shopping_kart', function (Blueprint $table) {
            $table->index('product_id');
            $table->index('user_id');
        });

        Schema::table('users_profile', function (Blueprint $table) {
            $table->index('user_id');
        });
    }

// $table->primary('id');	Adds a primary key.
// $table->primary(['id', 'parent_id']);	Adds composite keys.
// $table->unique('email');	Adds a unique index.
// $table->index('state');	Adds an index.
// $table->fullText('body');	Adds a full text index (MySQL/PostgreSQL).
// $table->fullText('body')->language('english');	Adds a full text index of the specified language (PostgreSQL).
// $table->spatialIndex('location');


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
