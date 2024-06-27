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
        Schema::create('user_festivals', function (Blueprint $table) {
            $table->id('user_festival_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('festival_id');
            $table->date('scheduled_date');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('festival_id')->references('festival_id')->on('festivals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_festivals');
    }
};
