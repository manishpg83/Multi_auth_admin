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
        Schema::create('user_smtp', function (Blueprint $table) {
            $table->id();
            $table->string('smtp_host');
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->integer('smtp_port');
            $table->string('smtp_from_name');
            $table->string('smtp_from_email');
            $table->enum('mailer_type', ['Gmail', 'Brevo', 'GetResponse']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_smtp');
    }
};
