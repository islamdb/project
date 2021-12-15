<?php

namespace App\Orchid\Screens;

use App\Models\Member;
use App\Models\Project;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BoardScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Board Of ';

    public $projectId;

    /**
     * Query data.
     *
     * @param $project
     * @return array
     */
    public function query($project): array
    {
        $this->projectId = $project;

        $project = Project::query()
            ->select(['id', 'name'])
            ->find($project);

        $this->name .= $project->name;

        return [
            'project' => $project->id
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Add Task')
                ->icon('plus')
                ->modal('taskModal')
                ->modalTitle('Add New Task')
                ->method('addTask')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::livewire('components.board'),
            Layout::modal('taskModal', [
                Layout::rows([
                    Input::make('data.project_id')
                        ->type('hidden')
                        ->value($this->projectId),
                    Input::make('data.name')
                        ->title('Name')
                ])
            ])->applyButton('Save'),
            Layout::modal('addToDo', [
                Layout::rows([
                    Input::make('data.task_id')
                        ->type('hidden')
                        ->value(request()->taskId),
                    Input::make('data.name')
                        ->title('Name')
                        ->required(),
                    Input::make('data.weight')
                        ->type('number')
                        ->step('0.0000000001')
                        ->title('Weight')
                        ->required(),
                    Select::make('data.member_id')
                        ->title('Member')
                        ->empty()
                        ->fromQuery(Member::query()->where('user_id', auth()->id()), 'name', 'id')
                ])
            ])->async('asyncAddToDo')
                ->applyButton(__('Save'))
        ];
    }

    public function asyncAddToDo($taskId)
    {
        return [
            'taskId' => $taskId
        ];
    }

    public function addTodo()
    {
        $data = request()->data;
        $data['position'] = DB::table('todos')
            ->where('task_id', $data['task_id'])
            ->max('position') + 1;

        Todo::query()->create($data);

        Toast::success('Saved');
    }

    public function deleteTodo()
    {
        DB::table('todos')->where('id', request()->id)->delete();

        Toast::success('Deleted');
    }

    public function deleteTask()
    {
        DB::table('tasks')->where('id', request()->id)->delete();

        Toast::success('Deleted');
    }

    public function addTask()
    {
        $data = request()->data;
        $data['position'] = DB::table('tasks')
            ->where('project_id', $data['project_id'])
            ->max('position') + 1;

        Task::query()->create($data);

        Toast::success('Saved');
    }
}
