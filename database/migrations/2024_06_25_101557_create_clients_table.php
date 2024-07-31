<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email');
            $table->string('company_name')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->integer('mail_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
       Schema::dropIfExists('clients');
    }
};