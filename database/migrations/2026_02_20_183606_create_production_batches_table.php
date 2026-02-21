<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ProductionBatches', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('ProductID');
            $table->unsignedBigInteger('UserID');
            $table->integer('QuantityProduced');
            $table->dateTime('ProductionDate');
            $table->dateTime('DateAdded');

            $table->foreign('ProductID')->references('ID')->on('Products')->onDelete('cascade');
            $table->foreign('UserID')->references('ID')->on('Users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ProductionBatches');
    }
};