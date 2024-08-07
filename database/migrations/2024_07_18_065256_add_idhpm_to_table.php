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
        Schema::table('lokasis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_harga_per_meter')->nullable();

            $table->foreign('id_harga_per_meter')->references('id')->on('harga_per_meter')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lokasis', function (Blueprint $table) {
            $table->dropForeign(['id_harga_per_meter']);
            
            $table->dropColumn('id_harga_per_meter');
        });
    }
};
