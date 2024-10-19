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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Название события
            $table->text('description')->nullable(); // Описание события
            $table->dateTime('event_date'); // Дата и время начала события
            $table->string('location')->nullable(); // Местоположение (для оффлайн событий)
            $table->boolean('is_public')->default(false); // Приватность события
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade'); // Организатор события
            $table->foreignId('category_id')->nullable()->constrained('event_categories')->onDelete('cascade'); // Категория события
            $table->foreignId('template_id')->nullable()->constrained('event_templates')->onDelete('cascade'); // Шаблон оформления
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade'); // Компания-организатор (обязательная)
            $table->text('terms_conditions')->nullable(); // Условия проведения
            $table->string('image_url')->nullable(); // Изображение/баннер для события
            $table->integer('max_participants')->nullable(); // Максимальное количество участников
            $table->integer('age_limit')->nullable(); // Возрастное ограничение
            $table->enum('event_type', ['online', 'offline'])->default('offline'); // Тип события (онлайн/оффлайн)
            $table->string('streaming_link')->nullable(); // Ссылка на трансляцию (для онлайн-событий)
            $table->json('tags')->nullable(); // Теги/метки для события
            $table->dateTime('registration_deadline')->nullable(); // Дата окончания регистрации на событие
            $table->string('qr_code')->nullable(); // QR-код для верификации на событии
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
