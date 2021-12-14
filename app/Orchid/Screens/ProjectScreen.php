<?php

namespace App\Orchid\Screens;

use App\Models\Member;
use App\Models\Project;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use IslamDB\OrchidHelper\Column;
use IslamDB\OrchidHelper\Screens\ResourceScreen;
use IslamDB\OrchidHelper\View;
use Orchid\Screen\TD;

class ProjectScreen extends ResourceScreen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Project';

    public $description = 'List all projects you have';

    public function model()
    {
        return Project::query()
            ->defaultSort('created_at')
            ->select([
                'id', 'name', 'price', 'max_weight',
                'task' => Task::query()
                    ->selectRaw('count(*)')
                    ->whereColumn('projects.id', 'tasks.project_id'),
                'todo' => Todo::query()
                    ->selectRaw('count(*)')
                    ->join('tasks as t', 't.id', 'task_id')
                    ->whereColumn('projects.id', 'project_id'),
                'member' => DB::table('member_todo as mt')
                    ->selectRaw('count(*)')
                    ->join('todos as td', 'td.id', 'mt.todo_id')
                    ->join('tasks as t', 't.id', 'task_id')
                    ->whereColumn('projects.id', 'project_id')
            ])
            ->where('user_id', auth()->id());
    }

    public function modelView()
    {
        return $this->model()
            ->addSelect(['created_at', 'updated_at']);
    }

    public function columns()
    {
        return [
            Column::make('name'),
            TD::make('task'),
            TD::make('todo', 'To Do'),
            TD::make('member', 'Member')
        ];
    }

    public function views()
    {
        return [
            View::relation('user', 'Created By'),
            View::make('name'),
            View::money('price'),
            View::make('description'),
            View::make('max_weight'),
            View::make('task'),
            View::make('todo'),
            View::make('member'),
            View::dateTime('created_at'),
            View::make('updated_at')
        ];
    }
}
