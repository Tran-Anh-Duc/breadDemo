<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeTotalPriceIntoBillProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_product', function (Blueprint $table) {
            $table->integer('total')->nullable();
            $table->integer('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_product', function (Blueprint $table) {
            $table->dropColumn('total')->nullable();
            $table->dropColumn('price')->nullable();
        });
    }
}
