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
        Schema::create('labour_family_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('labour_id');
            $table->string('full_name');
            $table->string('date_of_birth');
            $table->string('gender_id');
            $table->string('relationship_id');
            $table->string('married_status_id');
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labour_family_details');
    }
};
