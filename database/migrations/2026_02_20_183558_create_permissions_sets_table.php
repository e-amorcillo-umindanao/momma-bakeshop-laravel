<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('PermissionsSet', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('PermissionID');
            $table->boolean('Allowable')->default(true);

            $table->foreign('UserID')->references('ID')->on('Users')->onDelete('cascade');
            $table->foreign('PermissionID')->references('ID')->on('Permissions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('PermissionsSet');
    }
};