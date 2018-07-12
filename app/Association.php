<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Association extends Model implements \Terranet\Presentable\PresentableInterface
{
    use SoftDeletes;
    use \Terranet\Presentable\PresentableTrait;

    protected $presenter = 'App\\Presenters\\AssociationPresenter';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'latitude',
        'longitude',
        'address',
        'input_map_data',
        'phone_1',
        'phone_2',
        'website',
        'email',
        'is_published',
    ];
    

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Get the user that owns the association.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The association images.
     *
     * @return App\AssociationImage|null
     */
    public function images()
    {
        return $this->hasMany('App\AssociationImage');
    }

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
