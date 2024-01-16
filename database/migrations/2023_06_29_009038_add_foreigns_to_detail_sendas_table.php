<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_sendas', function (Blueprint $table) {
            $table
                ->foreign('answer_id')
                ->references('id')
                ->on('answers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreign('senda_id')
                ->references('id')
                ->on('sendas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_sendas', function (Blueprint $table) {
            $table->dropForeign(['answer_id']);
            $table->dropForeign(['senda_id']);
        });
    }
};
