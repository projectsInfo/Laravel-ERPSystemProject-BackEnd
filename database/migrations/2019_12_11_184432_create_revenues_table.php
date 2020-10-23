<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues_table', function (Blueprint $table) {
            $table->increments('id');
//            $table->datetimeTz('date');
            $table->bigInteger('transnum')->unique();
            $table->string('currency');
            $table->string('debit_acc');
            $table->string('credit_acc');
            $table->string('debit_amount');
            $table->string('credit_amount');
            $table->string('trans_id');
            $table->string('total_amount');
            $table->string('cheque_id')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revenues_table');
    }
}
