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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('type'); // Тип билета (например, "VIP", "General Admission")
            $table->decimal('price', 10, 2); // Цена билета
            $table->integer('quantity'); // Количество билетов
            $table->integer('sold_quantity')->default(0); // Сколько продано
            $table->decimal('discount', 10, 2)->nullable(); // Скидка на билет (если применимо)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
