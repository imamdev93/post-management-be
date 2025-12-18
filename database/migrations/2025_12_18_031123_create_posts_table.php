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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id')->unique();
            $table->integer('user_id');
            $table->string('title');
            $table->text('body');
            $table->string('category');
            $table->date('release_date');
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();

            $table->index('category');
            $table->index('release_date');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
