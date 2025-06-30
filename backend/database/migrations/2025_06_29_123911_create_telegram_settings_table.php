<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('telegram_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bot_token')->nullable();
            $table->string('bot_name')->nullable();
            $table->string('webhook_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telegram_settings');
    }
};
