<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_question_id');
            $table->foreign('room_question_id')->references('id')->on('room_questions');
            $table->string('answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_question_answers');
    }
};
