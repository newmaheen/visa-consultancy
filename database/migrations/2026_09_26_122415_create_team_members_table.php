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
    Schema::create('team_members', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('designation'); // e.g. Senior Immigration Consultant
        $table->string('specialization')->nullable(); // e.g. Study Visa (Canada & UK)
        $table->string('photo')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('linkedin_url')->nullable();
        $table->integer('order_priority')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
