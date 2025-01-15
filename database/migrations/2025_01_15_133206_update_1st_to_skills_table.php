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
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('presentage');
            $table->string('level', 100)->default('Basic');
            $table->string('category', 100)->default('Front End');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->addColumn('tinyInteger', 'presentage');
            $table->dropColumn(['level', 'category']);
        });
    }
};
