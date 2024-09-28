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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Если приглашенный пользователь уже зарегистрирован в системе
            $table->string('recipient_contact'); // Контакт получателя (email или телефон)
            $table->enum('channel', ['email', 'sms', 'whatsapp', 'telegram', 'viber', 'facebook']); // Канал отправки
            $table->text('message')->nullable(); // Персонализированное сообщение
            $table->string('invitation_link'); // Уникальная ссылка для регистрации
            $table->enum('status', ['pending', 'sent', 'delivered', 'failed'])->default('pending'); // Статус приглашения
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
