<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        $avatarId = $this->query->get('user')->avatar_id ?? null;

        return [
            Cropper::make('user.avatar')
                ->title('Avatar')
                ->width(200)
                ->targetId()
                ->value($avatarId)
                ->height(200),

            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.username')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Username'))
                ->placeholder(__('Username')),

            Input::make('user.email')
                ->type('email')
                ->max(255)
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
        ];
    }
}
