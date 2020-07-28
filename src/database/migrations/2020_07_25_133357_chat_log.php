<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChatLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('chats');
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->enum('message_type',['private','group','discuss']);
            $table->enum('sub_type',['friend','group','discuss','other','normal','anonymous','notice'])->nullable();
            $table->integer('message_id');
            $table->integer('group_id')->nullable();
            $table->string('message')->nullable();
            $table->integer('font')->nullable();
            $table->bigInteger('anonymous_id')->nullable();
            $table->string('anonymous_name')->nullable();
            $table->string('anonymous_flag')->nullable();
            $table->bigInteger('sender_user_id')->nullable();
            $table->string('sender_nickname')->nullable();
            $table->string('sender_card')->nullable();
            $table->string('sender_role')->nullable();
            $table->string('reply')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
