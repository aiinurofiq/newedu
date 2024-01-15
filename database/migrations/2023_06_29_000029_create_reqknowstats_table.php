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
        Schema::create('reqknowstats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reqknowledge_id');
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->text('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reqknowstats');
    }
};
