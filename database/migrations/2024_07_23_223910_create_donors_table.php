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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->string('title');
            $table->tinyInteger('status')->default(1);
            $table->decimal('amount', 10, 2);
            $table->text('image')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['donation_id','payment_method_id','user_id'], 'donors_IDX');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donors');
    }
};
