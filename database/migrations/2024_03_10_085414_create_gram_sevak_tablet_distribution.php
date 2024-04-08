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
        Schema::create('gram_sevak_tablet_distribution', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('taluka_id');
            $table->unsignedBigInteger('village_id');
            $table->unsignedBigInteger('adhar_card_number');
            $table->string('full_name');
            $table->string('gram_panchayat_name');
            $table->string('mobile_number');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('aadhar_image')->default('null');
            $table->string('gram_sevak_id_card_photo')->default('null');
            $table->string('photo_of_beneficiary')->default('null');
            $table->string('photo_of_tablet_imei')->default('null');
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gram_sevak_tablet_distribution');
    }
};
