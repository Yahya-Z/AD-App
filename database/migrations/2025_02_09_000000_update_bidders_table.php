<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBiddersTable extends Migration
{
    public function up()
    {
        Schema::table('bidders', function (Blueprint $table) {
            $table->string('commercial_register')->nullable()->change();
            $table->string('tax_card')->nullable()->change();
            $table->string('zakat_card')->nullable()->change();
            $table->string('shop_license')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('bidders', function (Blueprint $table) {
            $table->boolean('commercial_register')->nullable()->change();
            $table->boolean('tax_card')->nullable()->change();
            $table->boolean('zakat_card')->nullable()->change();
            $table->boolean('shop_license')->nullable()->change();
        });
    }
}