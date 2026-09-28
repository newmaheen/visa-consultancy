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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');                          // e.g. "Student Visa Solutions"
            $table->string('badge_tag')->nullable();          // e.g. "Admissions Open"
            $table->text('short_description')->nullable();    // সংক্ষিপ্ত বিবরণ
            $table->string('thumbnail_image');                // অ্যাডমিন থেকে আপলোড করা ছবির পাথ
            $table->string('cta_btn_text')->default('Contact Now'); // বাটনের লেখা
            $table->boolean('is_active')->default(true);      // অ্যাক্টিভ/হাইড টগল
            $table->integer('order_priority')->default(0);    // সিরিয়াল
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
