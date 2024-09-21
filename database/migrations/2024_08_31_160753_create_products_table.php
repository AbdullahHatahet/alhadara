<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->integer('price');
            $table->timestamps();
        });
    }
    // 01H0WXWP3XGAX0ZJVG7Q2E70FC ulid
    // 8f8e8478-9035-4d23-b9a7-62f4d2612ce5 uuid

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
