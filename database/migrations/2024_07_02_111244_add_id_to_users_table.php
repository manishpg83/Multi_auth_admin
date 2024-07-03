<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddIdToUsersTable extends Migration
{
    public function up()
    {
        // Check if the 'id' column already exists
        if (!Schema::hasColumn('users', 'id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->id(); // Add this line to create an id column
            });
        }
    }

    public function down()
    {
        // Check if the 'id' column exists before attempting to drop it
        if (Schema::hasColumn('users', 'id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }
    }
}
