<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id('ID');
            $table->string('FullName', 255);
            $table->string('Username', 255)->unique();
            $table->string('Password', 255);
            $table->string('Role', 50); // Cashier, Inventory Clerk, Owner/Admin
            $table->string('Status', 20)->default('Active'); // Active or Inactive
            $table->dateTime('DateAdded');
            $table->dateTime('DateModified');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Users');
    }
};