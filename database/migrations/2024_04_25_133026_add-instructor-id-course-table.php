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
        //
        Schema::dropIfExists('courses');
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("instructorId");
            $table->bigInteger("categoryId");

            $table->string("title");
            $table->text("description");
            $table->bigInteger("durationHours");
            $table->bigInteger("durationMinutes");
            $table->string("picUrl");
            
            $table->double("price");
            

            $table->enum("status", ["Not Started","Ongoing","Completed"])->default("Not Started");
            // $table->unsignedBigInteger("user_id");
            // $table->foreign("user_id")->references("id")->on("users");
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
