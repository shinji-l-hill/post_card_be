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
        Schema::create('send_lists', function (Blueprint $table) {
            $table->string('name');
            $table->uuid('uuid')->unique(); 
            $table->unsignedBigInteger('user_id'); 
            $table->text('postcard_title')->nullable();
            $table->text('postcard_sentence')->nullable();
            $table->text('postcard_end')->nullable();
            $table->timestamps();

            // 外部キー制約（オプション）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_lists');
    }
};
