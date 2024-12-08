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
        Schema::create('event_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->integer('views')->default(0);
            $table->integer('tickets_sold')->default(0);
            $table->integer('subscriptions')->default(0);
            $table->integer('comments')->default(0);
            $table->integer('likes')->default(0);
            $table->float('rating')->default(0)->comment('event avg rating');
            $table->integer('participants')->default(0);
            $table->integer('shares')->default(0);
            $table->timestamps();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_metrics');
    }
};
