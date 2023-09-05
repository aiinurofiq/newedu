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
        Schema::table('reqknowledges', function (Blueprint $table) {
            $table
                ->foreign('explanation_id')
                ->references('id')
                ->on('explanations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('exsum_id')
                ->references('id')
                ->on('exsums')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('report_id')
                ->references('id')
                ->on('reports')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('jurnal_id')
                ->references('id')
                ->on('jurnals')
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
        Schema::table('reqknowledges', function (Blueprint $table) {
            $table->dropForeign(['explanation_id']);
            $table->dropForeign(['exsum_id']);
            $table->dropForeign(['report_id']);
            $table->dropForeign(['jurnal_id']);
            $table->dropForeign(['user_id']);
        });
    }
};
