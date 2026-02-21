<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Audits', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('UserID');
            $table->string('TableEdited', 255);
            $table->text('PreviousChanges')->nullable();
            $table->text('SavedChanges')->nullable();
            $table->string('Action', 50); // INSERT, UPDATE, DELETE
            $table->dateTime('DateAdded');

            $table->foreign('UserID')->references('ID')->on('Users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Audits');
    }
};