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
            $table->string('commercial_register'); // السجل التجاري
            $table->string('tax_card'); // البطاقة الضريبية
            $table->string('zakat_card'); // البطاقة الزكوية
            $table->string('shop_license'); // ترخيص المحل
            $table->text('notes')->nullable(); // ملاحظات
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bidders');
    }
};
