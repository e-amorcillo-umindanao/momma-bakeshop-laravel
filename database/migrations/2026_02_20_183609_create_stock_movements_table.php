<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('StockMovements', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('InventoryID');
            $table->unsignedBigInteger('UserID');
            $table->string('MovementType', 50); // Stock-In, Stock-Out
            $table->integer('Quantity');
            $table->string('Supplier', 255)->nullable();
            $table->dateTime('DateAdded');

            $table->foreign('InventoryID')->references('ID')->on('Inventory')->onDelete('cascade');
            $table->foreign('UserID')->references('ID')->on('Users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('StockMovements');
    }
};