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
        Schema::table('songs', function (Blueprint $table) {
            
            $table->dropForeign(['cd_id']);

            $table->foreign('cd_id')->references('id')->on('cds')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['cd_id']);
            $table->foreign('cd_id')->references('id')->on('cds')->onDelete('cascade');
         });
    }
};
