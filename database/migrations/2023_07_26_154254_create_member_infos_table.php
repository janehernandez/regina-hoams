<?php

use App\Models\MemberInfo;
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
        Schema::create('member_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('id_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', array_values(MemberInfo::GENDERS))->nullable();
            $table->enum('civil_status', array_values(MemberInfo::MARITAL_STATUSES))->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('block')->nullable();
            $table->integer('lot')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('status')->default(2)->comment('0 = disabled, 1 = Approved, 2 = Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_infos');
    }
};
