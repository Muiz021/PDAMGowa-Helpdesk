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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index('fk_pengaduans_to_users');
            $table->foreign('user_id','fk_pengaduans_to_users')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('jenis_pengaduan');
            $table->string('bukti_pengaduan');
            $table->string('status_pengaduan')->default('belum_selesai');
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
        Schema::dropIfExists('pengaduans');
    }
};
