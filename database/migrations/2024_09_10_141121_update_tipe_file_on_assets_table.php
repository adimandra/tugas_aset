<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTipeFileOnAssetsTable extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('tipe_file')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('tipe_file')->nullable(false)->change();
        });
    }
}
