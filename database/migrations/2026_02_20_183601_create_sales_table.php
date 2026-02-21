<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Sales', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('B2BClientID')->nullable();
            $table->string('TransactionType', 50); // Cash or Consignment
            $table->decimal('TotalAmount', 10, 2);
            $table->decimal('AmountTendered', 10, 2)->nullable();
            $table->decimal('Change', 10, 2)->nullable();
            $table->string('PaymentStatus', 20); // Paid, Pending
            $table->dateTime('DateAdded');

            $table->foreign('UserID')->references('ID')->on('Users')->onDelete('cascade');
            $table->foreign('B2BClientID')->references('ID')->on('B2BClients')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Sales');
    }
};