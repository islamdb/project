<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use IslamDB\OrchidHelper\Resource\Traits\ResourceDefaultAllowedSortsAndFilters;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property float $price
 * @property float $max-weight
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Task[] $tasks
 */
class Project extends Model
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
    protected $fillable = ['user_id', 'name', 'price', 'max_weight', 'description', 'started_at', 'finished_at', 'created_at', 'updated_at'];

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
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
