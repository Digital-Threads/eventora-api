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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('event_date');
            $table->string('location')->nullable();
            $table->boolean('is_public')->default(true);
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade'); // Организатор события
            $table->foreignId('template_id')->nullable()->constrained('event_templates')->onDelete('set null'); // Привязка к шаблону
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
