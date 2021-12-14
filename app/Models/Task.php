<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $project_id
 * @property integer $position
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property Project $project
 * @property Todo[] $todos
 */
class Task extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['project_id', 'position', 'name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function todos()
    {
        return $this->hasMany('App\Models\Todo');
    }
}
