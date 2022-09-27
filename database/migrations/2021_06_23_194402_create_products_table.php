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
            $table->unsignedBigInteger('categorias_id');
            $table->unsignedBigInteger('proveedores_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('price')->default(0);
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();

            $table->foreign('categorias_id')->references('id')->on('categorias');
            $table->foreign('proveedores_id')->references('id')->on('proveedores');
        });
    }

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
