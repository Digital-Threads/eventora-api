<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table): void {
            $table->id();
            $table->string('email')->nullable()->unique()->index();
            $table->string('email_verification_token')->nullable();
            $table->string('password')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('google_2fa_secret')->nullable();
            $table->string('google_2fa_recovery_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->unsignedBigInteger('role_id'); // Связь с таблицей ролей
            $table->unsignedBigInteger('company_id')->nullable(); // Связь с таблицей компаний

            // Внешние ключи
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            $table->timestamp('registered_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
