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
        Schema::table('biodatas', function (Blueprint $table) {
            $table->string('title', 100)->default('no title');
            $table->string('degree', 100)->default('bachelor degree');
            $table->date('birthday')->default(date('Y-m-d'));
            $table->text('photo2')->nullable();
            $table->longText('summary');
            $table->dropColumn(['passion', 'birth']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            $table->string('passion')->nullable();
            $table->date('birth')->nullable();
            $table->dropColumn(['title', 'birthday', 'photo2', 'summary', 'degree']);
        });
    }
};
