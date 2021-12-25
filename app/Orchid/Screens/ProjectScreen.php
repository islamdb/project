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
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
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
                'id', 'name', 'price', 'started_at', 'finished_at',
                'max_weight', 'description',
                'task' => Task::query()
                    ->selectRaw('count(*)')
                    ->whereColumn('projects.id', 'tasks.project_id'),
                'todo' => Todo::query()
                    ->selectRaw('count(*)')
                    ->join('tasks as t', 't.id', 'task_id')
                    ->whereColumn('projects.id', 'project_id')
            ])
            ->where('user_id', auth()->id());
    }

    public function modelView()
    {
        return $this->model()
            ->addSelect([
                'price',
                'max_weight',
                'created_at',
                'updated_at'
            ]);
    }

    public function columns()
    {
        return [
            Column::make('name'),
            TD::make('task'),
            TD::make('todo', 'To Do'),
            Column::dateTime('started_at', null, 'id', false),
            Column::dateTime('finished_at', null, 'id', false)
        ];
    }

    public function views()
    {
        return [
            View::make('name'),
            View::money('price', null, 2, true, ',', '.'),
            View::make('max_weight'),
            View::make('description'),
            View::make('max_weight'),
            View::make('task'),
            View::make('todo'),
            View::dateTime('started_at'),
            View::dateTime('finished_at'),
            View::dateTime('created_at'),
            View::dateTime('updated_at')
        ];
    }

    public function fields()
    {
        return [
            Input::make('data.name')
                ->title('Name')
                ->maxlength(255)
                ->required(),
            Input::make('data.price')
                ->title('Price')
                ->type('number')
                ->required(),
            Input::make('data.max_weight')
                ->title('Max Weight')
                ->type('number')
                ->required(),
            TextArea::make('data.description')
                ->title('Description')
                ->rows(4),
            DateTimer::make('data.started_at')
                ->title('Started At'),
            DateTimer::make('data.finished_at')
                ->title('Finished At'),
            Input::make('data.user_id')
                ->value(auth()->id())
                ->type('hidden')
                ->required()
        ];
    }

    public function actions($model)
    {
        $actions = parent::actions($model);
        $actions = array_merge([
            Link::make('Board')
                ->icon('note')
                ->route('platform.project.board', ['project' => $model->id])
        ], $actions);

        return $actions;
    }
}
