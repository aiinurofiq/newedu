<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('file')->nullable();
            $table->string('kodeklasifikasi');
            $table->string('jwp_aktif');
            $table->string('jwp_inaktif');
            $table->string('ha_internal');
            $table->string('ha_eksternal');
            $table->unsignedBigInteger('keterangan_id');
            $table->unsignedBigInteger('jenisarsip_id');
            $table->unsignedBigInteger('kkeamanan_id');
            $table->unsignedBigInteger('dasarpertimbangan_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
