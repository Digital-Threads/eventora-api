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
        Schema::create('invitation_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained('invitations')->onDelete('cascade'); // Ссылка на основное приглашение
            $table->string('recipient_contact'); // Email или телефон получателя
            $table->enum('channel', ['email', 'sms', 'whatsapp', 'telegram', 'viber', 'facebook']); // Канал отправки
            $table->enum('status', ['pending', 'sent', 'delivered', 'failed'])->default('pending'); // Статус отправки
            $table->integer('retry_count')->default(0); // Количество попыток отправки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_deliveries');
    }
};
