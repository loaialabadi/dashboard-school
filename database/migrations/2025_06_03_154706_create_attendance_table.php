<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('attendance', function (Blueprint $table) {
        $table->id();
        $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['present', 'absent'])->default('absent');
        $table->timestamp('attended_at')->nullable();
        $table->timestamps();

        $table->unique(['class_id', 'student_id']); // ضمان عدم تكرار حضور نفس الطالب لنفس الحصة
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
