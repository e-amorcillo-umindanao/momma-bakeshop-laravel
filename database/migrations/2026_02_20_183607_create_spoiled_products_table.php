<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('SpoiledProducts', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('SpoilageID');
            $table->unsignedBigInteger('ProductID');
            $table->unsignedBigInteger('BatchID')->nullable();
            $table->integer('Quantity');
            $table->decimal('SubAmount', 10, 2);
            $table->string('Reason', 255);
            $table->dateTime('DateAdded');

            $table->foreign('SpoilageID')->references('ID')->on('Spoilages')->onDelete('cascade');
            $table->foreign('ProductID')->references('ID')->on('Products')->onDelete('cascade');
            $table->foreign('BatchID')->references('ID')->on('ProductionBatches')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('SpoiledProducts');
    }
};