<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZalorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zaloras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_Sepatu');
            $table->string('deskripsi');
            $table->BigInteger('harga');
            $table->BigInteger('stock_sepatu');
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
        Schema::dropIfExists('zaloras');
    }
}
