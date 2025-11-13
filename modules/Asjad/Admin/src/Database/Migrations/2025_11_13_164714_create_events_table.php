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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key to event_categories table
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('event_categories')->onDelete('set null');

            // Event details
            $table->string('event_name');
            $table->date('event_date');
            $table->integer('guest_count')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->text('description')->nullable();

            // Status (pending, confirmed, completed, cancelled)
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
