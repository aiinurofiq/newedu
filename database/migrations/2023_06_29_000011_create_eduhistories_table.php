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
        Schema::create('eduhistories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('major');
            $table->unsignedBigInteger('university_id');
            $table->unsignedBigInteger('city_id');
            $table->year('year');
            $table->string('academic_degree')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->boolean('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eduhistories');
    }
};
