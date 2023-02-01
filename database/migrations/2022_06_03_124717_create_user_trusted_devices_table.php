<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('user_trusted_devices', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->ipAddress('ip');
            $table->string('user_agent')->nullable();
            $table->timestamp('valid_to');

            $table->unique(['user_id', 'ip', 'user_agent']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_trusted_devices');
    }
};
