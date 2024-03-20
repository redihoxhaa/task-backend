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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('bg_color_hex')->default('#f2f2f2')->nullable()->change();
            $table->string('text_color_hex')->default('#222222')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('bg_color_hex', 7)->default('#f2f2f2')->nullable()->change();
            $table->string('text_color_hex', 7)->default('#222222')->nullable()->change();
        });
    }
};
