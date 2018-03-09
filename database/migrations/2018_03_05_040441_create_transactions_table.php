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
            $table->uuid('user_uuid');
            $table->uuid('wallet_uuid');
            $table->uuid('category_uuid');
            $table->date('date');
            $table->decimal('value');
            $table->timestamps();
            $table->primary('uuid');
            $table->foreign('user_uuid')
                ->on('users')
                ->references('uuid');
            $table->foreign('wallet_uuid')
                ->on('wallets')
                ->references('uuid');
            $table->foreign('category_uuid')
                ->on('categories')
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
