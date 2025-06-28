<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('author')->nullable();
            $table->longText('content')->nullable();
            $table->string('repo_url')->nullable();
            $table->string('preview_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('type')->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->unsignedInteger('star_count')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            // Foreign key constraint to users table (optional but recommended)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template');
    }
};
