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
        Schema::table('arsips', function (Blueprint $table) {
            $table
                ->foreign('keterangan_id')
                ->references('id')
                ->on('keterangans')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('jenisarsip_id')
                ->references('id')
                ->on('jenisarsips')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('kkeamanan_id')
                ->references('id')
                ->on('kkeamanans')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('dasarpertimbangan_id')
                ->references('id')
                ->on('dasarpertimbangans')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->dropForeign(['keterangan_id']);
            $table->dropForeign(['jenisarsip_id']);
            $table->dropForeign(['kkeamanan_id']);
            $table->dropForeign(['dasarpertimbangan_id']);
            $table->dropForeign(['user_id']);
        });
    }
};
