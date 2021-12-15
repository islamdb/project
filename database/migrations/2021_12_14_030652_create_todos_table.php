<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')
                ->references('id')
                ->on('tasks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('member_id')
                ->nullable()
                ->references('id')
                ->on('members')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('position')
                ->index();
            $table->text('name');
            $table->double('weight');
            $table->timestamps();

            $table->unique(['task_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
