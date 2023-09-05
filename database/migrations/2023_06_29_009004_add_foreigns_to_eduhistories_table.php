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
        Schema::table('eduhistories', function (Blueprint $table) {
            $table
                ->foreign('education_id')
                ->references('id')
                ->on('educations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('university_id')
                ->references('id')
                ->on('universities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('city_id')
                ->references('id')
                ->on('cities')
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
        Schema::table('eduhistories', function (Blueprint $table) {
            $table->dropForeign(['education_id']);
            $table->dropForeign(['university_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['user_id']);
        });
    }
};
