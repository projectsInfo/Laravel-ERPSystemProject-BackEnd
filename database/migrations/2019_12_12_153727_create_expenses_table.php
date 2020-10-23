<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transnum')->unique();
            $table->string('currency');
            $table->integer('debit_acc');
            $table->integer('credit_acc');
            $table->float('debit_amount');
            $table->float('credit_amount');
            $table->integer('trans_id');
            $table->float('total_amount');
            $table->string('cheque_id')->nullable();
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
        Schema::dropIfExists('expenses_table');
    }
}
