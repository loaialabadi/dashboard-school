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
Schema::table('students', function (Blueprint $table) {
    $table->enum('grade', [
        'أولى ابتدائي', 'ثانية ابتدائي', 'ثالثة ابتدائي', 'رابعة ابتدائي', 'خامسة ابتدائي', 'سادسة ابتدائي',
        'أولى إعدادي', 'ثانية إعدادي', 'ثالثة إعدادي',
        'أولى ثانوي', 'ثانية ثانوي', 'ثالثة ثانوي'
    ])->after('phone');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
