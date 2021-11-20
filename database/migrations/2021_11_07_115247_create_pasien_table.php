<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id(); // ID Pasien
            $table->string('name'); //Nama Pasien
            $table->string('phone'); //No HP Pasien
            $table->text('address'); //Alamat Pasien
            $table->string('status');//Status Pasien
            $table->date('in_date_at');//Tanggal Masuk
            $table->date('out_date_at')->nullable();//Tanggal Keluar
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
        Schema::dropIfExists('pasiens');
    }
}
