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
        Schema::create('festivals', function (Blueprint $table) {
            $table->id('festival_id');
            $table->string('name');
            $table->date('date');
            $table->enum('status', ['active', 'inactive']);
            $table->string('email_scheduled', 500)->nullable(); // Increase the length
            $table->string('subject_line')->nullable();
            $table->text('email_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
};
