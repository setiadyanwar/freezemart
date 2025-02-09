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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'comments_user_id'
            );
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'comments_product_id'
            );
            $table->foreignId('parent_id')->nullable()->constrained(
                table: 'comments',
                indexName: 'comments_parent_id'
            )->onDelete('cascade'); // Kalau komentar induk dihapus, reply ikut kehapus
            $table->text('comment_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
