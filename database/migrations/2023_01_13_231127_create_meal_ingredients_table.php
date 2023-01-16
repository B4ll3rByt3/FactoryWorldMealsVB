<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_ingredients', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('meal_id')
                    ->references('id')
                    ->on('meals')
                    ->onDelete('cascade');
            $table->foreign('ingredient_id')
                    ->references('id')
                    ->on('ingredients')
                    ->onDelete('cascade');
            $table->primary(['meal_id','ingredient_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_ingredients');
    }
};
