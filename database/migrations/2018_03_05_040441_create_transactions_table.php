<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->uuid('user');
            $table->uuid('wallet');
            $table->date('date');
            $table->decimal('value');
            $table->timestamps();
            $table->primary('uuid');
            $table->foreign('user')
                ->on('users')
                ->references('uuid');
            $table->foreign('wallet')
                ->on('wallets')
                ->references('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
