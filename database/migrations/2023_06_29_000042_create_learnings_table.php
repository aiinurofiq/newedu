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
        Schema::create('learnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->uuid('uuid')
                ->nullable()
                ->unique();
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description');
            $table->enum('type', ['0', '1', '2'])->default('0');
            $table->decimal('price')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categorylearn_id');
            $table->enum('level', ['0', '1', '2', '3']);
            $table->boolean('ispublic');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learnings');
    }
};
