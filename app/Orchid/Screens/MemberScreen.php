<?php

namespace App\Orchid\Screens;

use App\Models\Member;
use Illuminate\Validation\Rules\In;
use IslamDB\OrchidHelper\Column;
use IslamDB\OrchidHelper\Screens\ResourceScreen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;

class MemberScreen extends ResourceScreen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Member';

    public $description = 'List of your members';

    public function model()
    {
        return Member::query()
            ->where('user_id', auth()->id());
    }

    public function columns()
    {
        return [
            Column::make('name'),
            Column::dateTime('created_at')
        ];
    }

    public function fields()
    {
        return [
            Input::make('data.user_id')
                ->type('hidden')
                ->value(auth()->id()),
            Input::make('data.name')
                ->required()
                ->title('Name')
        ];
    }
}
