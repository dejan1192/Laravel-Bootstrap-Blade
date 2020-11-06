<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            // $table->id();
            $table->unsignedInteger('followee_id');
            $table->unsignedInteger('follower_id');
            $table->foreign('follower_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('followee_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->timestamps();

            $table->primary(['followee_id', 'follower_id']);
            $table->unique(['follower_id', 'followee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
