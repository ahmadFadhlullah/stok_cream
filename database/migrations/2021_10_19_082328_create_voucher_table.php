<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->string('kode_voucher');
            $table->string('text_voucher');
            $table->mediumText('text_rule');
            $table->enum('status',['aktif','kadaluwarsa']);
            $table->enum('nilai',['nominal','persen']);
            $table->integer('nilai_fisik');
            $table->enum('type',['hidden','show']);
            $table->enum('target',['User Baru','Custom','Default']);
            $table->integer('nilai_target')->nullable();
            $table->enum('maksimal_voucher',['Default','Custom','Unlimited']);
            $table->integer('nilai_maksimal_voucher')->nullable();
            $table->date('tanggal_pembuatan');
            $table->date('tanggal_kadaluwarsa');
            $table->enum('maksimal_limit_voucher',['Custom','Default']);
            $table->integer('nilai_maksimal_limit_voucher')->nullable();
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
        Schema::dropIfExists('voucher');
    }
}
