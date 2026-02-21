<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Inventory', function (Blueprint $table) {
            $table->id('ID');
            $table->string('ItemName', 255);
            $table->string('ItemDescription', 255)->nullable();
            $table->string('Measurement', 50);
            $table->integer('Quantity')->default(0);
            $table->integer('LowStockThreshold');
            $table->dateTime('DateAdded');
            $table->dateTime('DateModified');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Inventory');
    }
};