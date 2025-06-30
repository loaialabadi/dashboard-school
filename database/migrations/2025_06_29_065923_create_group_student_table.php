<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
<<<<<<<< HEAD:database/migrations/2025_06_03_154706_create_attendances_table.php
 public function up()
{
Schema::create('attendances', function (Blueprint $table) {
    $table->id();
$table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade');
    $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
    $table->enum('status', ['present', 'absent']);
    $table->dateTime('attended_at');
========
    public function up(): void
    {
        Schema::create('group_student', function (Blueprint $table) {
     $table->id();
    $table->foreignId('group_id')->constrained()->onDelete('cascade');
    $table->foreignId('student_id')->constrained()->onDelete('cascade');
>>>>>>>> 9bc6eba291411c5a942f787a29c23fac27225125:database/migrations/2025_06_29_065923_create_group_student_table.php
    $table->timestamps();

    $table->unique(['group_id', 'student_id']); // نفس الطالب لا يتكرر داخل نفس المجموعة
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2025_06_03_154706_create_attendances_table.php
        Schema::dropIfExists('attendances');
========
        Schema::dropIfExists('group_student');
>>>>>>>> 9bc6eba291411c5a942f787a29c23fac27225125:database/migrations/2025_06_29_065923_create_group_student_table.php
    }
};
