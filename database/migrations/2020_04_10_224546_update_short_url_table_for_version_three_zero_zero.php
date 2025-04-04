<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateShortURLTableForVersionThreeZeroZero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->timestamp('activated_at')->after('track_device_type')->nullable()->default(now());
            $table->timestamp('deactivated_at')->after('activated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->dropColumn(['activated_at', 'deactivated_at']);
        });
    }
}
