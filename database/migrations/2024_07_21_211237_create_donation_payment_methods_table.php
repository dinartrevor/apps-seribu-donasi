<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->string('account_number');
            $table->string('account_holder_name');
            $table->timestamps();
            $table->index(['donation_id','payment_method_id'], 'donation_payment_methods_IDX');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_payment_methods');
    }
};
