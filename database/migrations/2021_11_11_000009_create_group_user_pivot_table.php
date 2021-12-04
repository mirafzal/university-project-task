<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_5268197')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id', 'group_id_fk_5268197')->references('id')->on('groups')->onDelete('cascade');
        });
    }
}
