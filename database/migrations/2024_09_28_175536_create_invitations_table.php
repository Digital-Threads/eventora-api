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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade'); // Ссылка на событие
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Если приглашенный пользователь уже зарегистрирован в системе
            $table->string('message')->nullable(); // Персонализированное сообщение
            $table->string('invitation_link'); // Уникальная ссылка для регистрации
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
