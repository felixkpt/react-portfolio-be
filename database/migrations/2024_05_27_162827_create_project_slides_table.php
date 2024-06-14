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
        Schema::create('project_slides', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('project_id');
            $table->string("image")->nullable();
            $table->string('caption')->nullable();
            $table->text('description')->nullable();

            $table->unsignedInteger('priority')->default(9999);
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_slides');
    }
};
