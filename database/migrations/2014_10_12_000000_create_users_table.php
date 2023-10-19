<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nosamb')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->text('alamat')->nullable();
            $table->text('no_whatsapp')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('roles');
            $table->boolean('is_verification')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
