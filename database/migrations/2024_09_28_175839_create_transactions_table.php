<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Пользователь, который совершил транзакцию
            $table->foreignId('subscription_plan_id')->nullable()->constrained('subscription_plans')->onDelete('cascade'); // Подписка (если применимо)

            $table->enum('transaction_type', ['subscription', 'purchase']); // Тип транзакции (подписка или покупка)
            $table->decimal('amount', 10, 2); // Сумма транзакции
            $table->string('payment_method'); // Метод оплаты (например, "Stripe", "PayPal")
            $table->string('transaction_id')->nullable(); // ID транзакции в платежной системе
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Статус транзакции

            $table->timestamp('completed_at')->nullable(); // Когда транзакция была завершена (если применимо)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
