<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30);
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->unsignedInteger('adults')->default(2);
            $table->unsignedInteger('children')->default(0);
            $table->string('room_category');
            $table->text('message')->nullable();
            $table->boolean('agreed_to_terms')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};
