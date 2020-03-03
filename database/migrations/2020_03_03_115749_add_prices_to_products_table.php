<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPricesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('price_one_week');
            $table->integer('price_two_week');
            $table->integer('price_three_week');
            $table->integer('price_four_week');
            $table->integer('price_more_month');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price_one_week');
            $table->dropColumn('price_two_week');
            $table->dropColumn('price_three_week');
            $table->dropColumn('price_four_week');
            $table->dropColumn('price_more_month');
        });
    }
}
