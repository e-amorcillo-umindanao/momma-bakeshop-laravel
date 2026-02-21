<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('B2BClients', function (Blueprint $table) {
            $table->id('ID');
            $table->string('ClientName', 255);
            $table->string('ContactDetails', 255)->nullable();
            $table->string('DeliveryAddress', 255)->nullable();
            $table->dateTime('DateAdded');
            $table->dateTime('DateModified');
        });
    }

    public function down()
    {
        Schema::dropIfExists('B2BClients');
    }
};