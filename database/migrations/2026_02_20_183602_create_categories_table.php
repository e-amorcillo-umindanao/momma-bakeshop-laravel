<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Category', function (Blueprint $table) {
            $table->id('ID');
            $table->string('CategoryName', 100);
            $table->text('Description')->nullable();
            $table->dateTime('DateAdded');
            $table->dateTime('DateModified');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Category');
    }
};