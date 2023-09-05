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
        Schema::table('reqknowstats', function (Blueprint $table) {
            $table
                ->foreign('reqknowledge_id')
                ->references('id')
                ->on('reqknowledges')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reqknowstats', function (Blueprint $table) {
            $table->dropForeign(['reqknowledge_id']);
        });
    }
};
