<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonsTable extends Migration
{
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id', 'room_fk_5268155')->references('id')->on('rooms');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id', 'group_fk_5268158')->references('id')->on('groups');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id', 'teacher_fk_5268159')->references('id')->on('users');
        });
    }
}
