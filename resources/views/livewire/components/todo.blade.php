<tr>
    <td @if($todo['status'] == 'FINISH') class="table-success" @else @endif>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <x-orchid-icon path="options-vertical"/>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <div class="form-group mb-0">
                        <button class="btn btn-link" wire:click="finished">
                            Finished
                        </button>
                    </div>
                </li>
                <li>
                    <div class="form-group mb-0">
                        <button class="btn btn-link" wire:click="unfinished">
                            Unfinished
                        </button>
                    </div>
                </li>
                <li>
                    {!! \Orchid\Screen\Actions\Button::make('Delete')->action(route('platform.project.board', ['project' => $projectId, 'method' => 'deleteTodo', 'id' => $todo['id']])) !!}
                </li>
            </ul>
        </div>
    </td>
    <td @if($todo['status'] == 'FINISH') class="table-success" @else @endif>
        <input type="text" class="form-control" wire:model.debounce.500ms="todo.name" style="font-size: 12px">
        <span style="font-size: 10px">{{ $todo['name'] }}</span>
    </td>
    <td @if($todo['status'] == 'FINISH') class="table-success" @else @endif>
        <input type="number" step="0.0000000001" class="form-control" wire:model.debounce.500ms="todo.weight">
    </td>
    <td @if($todo['status'] == 'FINISH') class="table-success" @else @endif>
        <select class="form-control" wire:model.lazy="todo.member_id" wire:ignore>
            <option value="">Choose</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}" @if($member->id == $todo['member_id']) selected @endif>
                    {{ $member->name }}
                </option>
            @endforeach
        </select>
    </td>
</tr>
