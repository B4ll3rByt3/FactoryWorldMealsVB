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
        Schema::create('meal_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('meal_id')
                    ->references('id')
                    ->on('meals')
                    ->onDelete('cascade');
            $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');
            $table->primary(['meal_id','tag_id']);
            $table->softDeletes();
            $table->index(['meal_id','tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_tags');
    }
};
