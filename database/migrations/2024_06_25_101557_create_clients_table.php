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

        /* Schema::create('client_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_subscribed')->default(true);
            $table->timestamps();

            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->unique(['client_id', 'user_id']);
        }); */
    }

    public function down(): void
    {
/*         Schema::dropIfExists('client_user');
 */        Schema::dropIfExists('clients');
    }
};