<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use IslamDB\OrchidHelper\Resource\Traits\ResourceDefaultAllowedSortsAndFilters;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $username
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Todo[] $todos
 */
class Member extends Model
{
    use Filterable,
        AsSource,
        Attachable,
        ResourceDefaultAllowedSortsAndFilters;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'username', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function todos()
    {
        return $this->hasMany('App\Models\Todo');
    }
}
