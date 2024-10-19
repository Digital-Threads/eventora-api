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
        Schema::create('social_providers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Связь с пользователем
            $table->string('provider_name'); // Имя провайдера (например, 'google', 'facebook')
            $table->string('provider_id')->unique(); // Уникальный ID от провайдера
            $table->timestamps();

            // Внешний ключ
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_providers');
    }
};
