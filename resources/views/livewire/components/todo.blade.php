<tr>
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <x-orchid-icon path="options-vertical"/>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    {!! \Orchid\Screen\Actions\Button::make('delete')->icon('trash')->action(route('platform.project.board', ['project' => $projectId, 'method' => 'deleteTodo', 'id' => $todo['id']])) !!}
                </li>
            </ul>
        </div>
    </td>
    <td>
        <input type="text" class="form-control" wire:model.debounce.500ms="todo.name" style="font-size: 12px">
    </td>
    <td>
        <input type="number" step="0.0000000001" class="form-control" wire:model.debounce.500ms="todo.weight">
    </td>
    <td>
        <select class="form-control" wire:model.lazy="todo.member_id">
            <option>Choose</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}" @if($member->id == $todo['member_id']) selected @endif>
                    {{ $member->name }}
                </option>
            @endforeach
        </select>
    </td>
</tr>
