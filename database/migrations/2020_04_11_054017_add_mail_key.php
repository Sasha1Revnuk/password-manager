<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'email_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email_id')->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'email_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('email_id');
            });
        }
    }
}
