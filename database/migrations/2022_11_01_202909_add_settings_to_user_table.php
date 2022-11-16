<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->boolean('color_mode')->nullable()->after('gender')->default(false);
            $table->boolean('fix_nav')->nullable()->after('color_mode')->default(false);
            $table->string('color')->nullable()->after('fix_nav');

        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('color_mode');
            $table->dropColumn('fix_nav');
            $table->dropColumn('color');
        });
    }
}
