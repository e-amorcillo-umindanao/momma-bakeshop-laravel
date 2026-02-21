<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Spoilages', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('UserID');
            $table->decimal('TotalAmount', 10, 2);
            $table->dateTime('DateAdded');

            $table->foreign('UserID')->references('ID')->on('Users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Spoilages');
    }
};