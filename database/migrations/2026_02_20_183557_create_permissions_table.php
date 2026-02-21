<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Permissions', function (Blueprint $table) {
            $table->id('ID');
            $table->string('PermissionName', 255);
            $table->text('PermissionDesc')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Permissions');
    }
};