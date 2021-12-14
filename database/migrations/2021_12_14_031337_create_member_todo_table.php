<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_todo', function (Blueprint $table) {
            $table->foreignId('member_id')
                ->references('id')
                ->on('members')
                ->cascadeOnDelete()
                ->cascadeOnDelete()
                ->nullable();
            $table->foreignId('todo_id')
                ->references('id')
                ->on('todos')
                ->cascadeOnDelete()
                ->cascadeOnDelete()
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_todo');
    }
}
