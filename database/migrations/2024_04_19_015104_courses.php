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
        Schema::create("courses", function(blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->int("durationHours");
            $table->int("durationMinutes");
            $table->string("prl");
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
