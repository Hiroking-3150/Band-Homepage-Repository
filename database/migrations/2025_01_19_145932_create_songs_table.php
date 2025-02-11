<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('cd_id')->nullable();
            $table->timestamps();
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->foreign('cd_id')
                  ->references('id')->on('cds')
                  ->onDelete('set null'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
