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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('offer_number'); // رقم العرض
            $table->string('project'); // اسم المشروع
            $table->string('item'); // البند
            $table->string('committees_members'); // أعضاء اللجنة
            $table->string('committees_chairman'); // رئيس اللجنة
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
