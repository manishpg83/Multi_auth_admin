<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultSmtpSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('default_smtp_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mailer_type');
            $table->string('smtp_host');
            $table->integer('smtp_port');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('default_smtp_settings');
    }
}

