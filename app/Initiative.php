<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Initiative extends Model implements \Terranet\Presentable\PresentableInterface
{
    use SoftDeletes;
    use \Terranet\Presentable\PresentableTrait;

    protected $presenter = 'App\\Presenters\\InitiativePresenter';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'initiative_type_id',
        'title',
        'description',
        'latitude',
        'longitude',
        'address',
        'input_map_data',
        'start_date',
        'end_date',
        'is_published'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The initiative type.
     *
     * @return App\InitiativeType|null
     */
    public function initiativeType()
    {
        return $this->belongsTo('App\InitiativeType');
    }

    /**
     * The initiative user.
     *
     * @return App\User|null
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The initiative images.
     *
     * @return App\InitiativeImage|null
     */
    public function images()
    {
        return $this->hasMany('App\InitiativeImage');
    }

    /**
     * Get initiative comments.
     *
     * @return App\Comment|null
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
