<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('event_title')->comment('イベントタイトル');
            $table->dateTime('event_datetime')->comment('イベント日時');
            $table->string('event_location')->comment('開催場所');
            $table->text('event_detail')->nullable()->comment('イベント詳細');
            $table->unsignedBigInteger('songs_id')->nullable()->comment('Songsテーブルとのリレーション');
            $table->timestamps();

            $table->foreign('songs_id')->references('id')->on('songs');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
