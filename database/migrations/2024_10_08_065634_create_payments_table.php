<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id');
            $table->string('amount');
            $table->string('transaction_id');
            $table->string('status');
            $table->string('currency');
            $table->string('payment_type');
            $table->string('payment_method');
            $table->string('payment_to');
            $table->string('payment_from');
            $table->string('payment_for');
            $table->string('expense_type');
            $table->text('remarks');
            $table->timestamp('payment_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
