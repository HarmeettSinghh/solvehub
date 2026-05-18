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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('voteable_id');
            $table->string('voteable_type');
            $table->tinyInteger('value'); // +1 for upvote, -1 for downvote
            $table->timestamps();

            // Prevent duplicate votes: one vote per user per item
            $table->unique(['user_id', 'voteable_id', 'voteable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
