<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedColumnToFestivalsTable extends Migration
{
    public function up()
    {
        Schema::table('festivals', function (Blueprint $table) {
            $table->boolean('approved')->default(false);
        });
    }

    public function down()
    {
        Schema::table('festivals', function (Blueprint $table) {
            $table->dropColumn('approved');
        });
    }
}


