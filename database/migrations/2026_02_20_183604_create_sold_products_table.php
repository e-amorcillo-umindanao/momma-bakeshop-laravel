<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('SoldProducts', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('SalesID');
            $table->unsignedBigInteger('ProductID');
            $table->integer('Quantity');
            $table->decimal('SubAmount', 10, 2);
            $table->dateTime('DateAdded');

            $table->foreign('SalesID')->references('ID')->on('Sales')->onDelete('cascade');
            $table->foreign('ProductID')->references('ID')->on('Products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('SoldProducts');
    }
};