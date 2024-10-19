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
        Schema::create('event_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Пользователь, купивший билет
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade'); // Мероприятие
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->onDelete('cascade'); // Связанный билет

            $table->decimal('amount', 10, 2); // Сумма покупки
            $table->string('payment_method'); // Метод оплаты
            $table->string('transaction_id')->nullable(); // ID транзакции в платежной системе
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Статус

            $table->timestamp('completed_at')->nullable(); // Дата завершения транзакции
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_transactions');
    }
};
