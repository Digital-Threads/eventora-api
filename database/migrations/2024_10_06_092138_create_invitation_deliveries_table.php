<?php

use Modules\Invitation\InvitationDelivery\Enums\InvitationDeliveryChannel;
use Modules\Invitation\InvitationDelivery\Enums\InvitationDeliveryStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invitation_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained('invitations')->onDelete('cascade'); // Ссылка на основное приглашение
            $table->string('recipient_contact'); // Email или телефон получателя
            $table->string('url');
            $table->enum('channel', (array) InvitationDeliveryChannel::class)->default(InvitationDeliveryChannel::EMAIL->value); // Канал отправки
            $table->enum('status', (array) InvitationDeliveryStatus::class)->default(InvitationDeliveryStatus::PENDING->value); // Статус отправки
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
