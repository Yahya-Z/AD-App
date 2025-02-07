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
        Schema::create('bidders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->onDelete('cascade');
            $table->string('name'); // اسم المتقدم
            $table->string('currency'); // عملة العطاء
            $table->decimal('amount', 10, 2); // المبلغ المقدم
            $table->decimal('discount', 10, 2)->default(0); // التخفيض
            $table->decimal('final_amount', 10, 2); // المبلغ بعد التخفيض
            $table->boolean('commercial_register')->default(false); // السجل التجاري
            $table->boolean('tax_card')->default(false); // البطاقة الضريبية
            $table->boolean('zakat_card')->default(false); // البطاقة الزكوية
            $table->boolean('shop_license')->default(false); // ترخيص المحل
            $table->text('notes')->nullable(); // ملاحظات
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidders');
    }
};
