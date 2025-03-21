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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('iata_code', 3)->unique();        // رمز المطار (مثل JFK, DXB)
            $table->string('name');                          // اسم المطار
            $table->string('city');                          // اسم المدينة
            $table->string('country')->nullable();           // اسم الدولة
            $table->string('country_code', 2)->nullable();   // رمز الدولة
            $table->decimal('latitude', 10, 7)->nullable();  // خط العرض
            $table->decimal('longitude', 10, 7)->nullable(); // خط الطول
            $table->timestamps();

            $table->index('iata_code');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};