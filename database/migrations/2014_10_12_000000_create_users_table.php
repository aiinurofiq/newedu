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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->uuid('uuid')
                ->nullable()
                ->unique();
            $table->string('nik');
            $table->string('kopeg')->unique();
            $table->string('name');
            $table->unsignedBigInteger('city_id');
            $table->date('birth');
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('religion_id');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('npwp');
            $table->unsignedBigInteger('tribe_id');
            $table->unsignedBigInteger('bloodtype_id');
            $table->unsignedBigInteger('marital_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
