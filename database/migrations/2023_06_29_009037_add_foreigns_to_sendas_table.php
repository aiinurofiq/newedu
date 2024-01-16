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
        Schema::table('sendas', function (Blueprint $table) {
            // $table
            //     ->foreign('answer_id')
            //     ->references('id')
            //     ->on('answers')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreign('quiz_id')
                ->references('id')
                ->on('quizzes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sendas', function (Blueprint $table) {
            // $table->dropForeign(['answer_id']);
            // $table->dropForeign(['user_id']);
            // $table->dropForeign(['quiz_id']);
        });
    }
};
