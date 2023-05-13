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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId("category_id")
                ->references("id")
                ->on("categories")
            ->onDelete("CASCADE");

            $table->foreignId("user_id")
                ->references("id")
                ->on("users")
            ->onDelete("CASCADE");


            $table->string("title", 200);
            $table->text("description");
            $table->smallInteger("urgency");
            $table->boolean("is_done")->default(false);
            $table->timestamps();
            $table->dateTime("due_date");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("tasks", function(Blueprint $table) {
            $table->dropForeign("category_id");
            $table->dropForeign("user_id");
        });
        
        Schema::dropIfExists('tasks');
    }
};
