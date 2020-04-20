<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->integer('price')->nullable();
            $table->text('additional')->nullable();
            $table->string('baselinker_id')->nullable();
            $table->text('icon')->nullable();
            $table->timestamps();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('delivery_id')->nullable();
            $table->integer('delivery_price')->nullable();
            $table->integer('delivery_additional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivery_id');
            $table->dropColumn('delivery_price');
            $table->dropColumn('delivery_additional');
        });
        Schema::dropIfExists('deliveries');
    }
}
