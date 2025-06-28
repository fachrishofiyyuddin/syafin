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
        Schema::create('bot_commands', function (Blueprint $table) {
            $table->id();
            $table->string('command')->unique(); // contoh: /faq_apa
            $table->string('label');             // contoh: Apa itu kebutuhan keuangan online?
            $table->text('response');            // isi balasan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_commands');
    }
};
