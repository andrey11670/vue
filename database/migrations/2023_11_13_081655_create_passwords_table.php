<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('title');
            $table->string('password');
            $table->string('project')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('folder_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('folder_id')->references('id')->on('folders');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
};
