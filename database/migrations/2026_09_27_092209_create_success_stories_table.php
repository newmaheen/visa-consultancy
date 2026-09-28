<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('destination_country'); // e.g. Portugal, Czech Republic
            $table->string('visa_type'); // e.g. D1 Job Seeker, Work Permit, Student Visa
            $table->string('client_photo')->nullable(); // ক্লায়েন্টের ছবি
            $table->string('visa_copy')->nullable(); // ভিসার ছবি/ডকুমেন্ট প্রুফ
            $table->text('story')->nullable(); // ক্লায়েন্টের ছোট্ট রিভিউ বা গল্প
            $table->date('approval_date')->nullable(); // ভিসা অ্যাপ্রুভাল তারিখ
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('success_stories');
    }
};