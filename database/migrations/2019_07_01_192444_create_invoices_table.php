<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->string('client_id');
            $table->string('invoice_date')->nullable();
            $table->string('amount')->nullable();
            $table->string('balance')->default('0');
            $table->string('due_date')->nullable();
            $table->string('deposit_amount')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->longText('private_notes')->nullable();
            $table->string('status')->default('Draft');
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
        Schema::dropIfExists('invoices');
    }
}
