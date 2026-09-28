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
    Schema::create('inquiries', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone');
        $table->string('email')->nullable();
        $table->string('destination_country')->nullable(); // e.g. Canada, UK, Australia
        $table->string('service_type')->nullable(); // e.g. Student Visa, Work Visa
        $table->text('message')->nullable();
        $table->string('status')->default('New'); // New, Contacted, In Review, Converted, Rejected
        $table->text('admin_notes')->nullable(); // Admin can write call feedback
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
