<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Products', function (Blueprint $table) {
            $table->id('ID');
            $table->string('ProductName', 255);
            $table->string('ProductDescription', 255)->nullable();
            $table->unsignedBigInteger('CategoryID');
            $table->decimal('Price', 10, 2);
            $table->integer('Quantity')->default(0);
            $table->integer('LowStockThreshold');
            $table->dateTime('DateAdded');
            $table->dateTime('DateModified');

            $table->foreign('CategoryID')->references('ID')->on('Category')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Products');
    }
};