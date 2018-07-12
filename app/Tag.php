<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'is_main',
    ];


    /**
     * Get all of the associations that are assigned this tag.
     */
    public function associations()
    {
        return $this->morphedByMany('App\Association', 'taggable');
    }
}
