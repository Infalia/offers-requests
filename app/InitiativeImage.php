<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InitiativeImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'initiative_id',
        'name',
        'url',
        'size',
    ];


    /**
     * Get the association that owns the images.
     */
    public function initiative()
    {
        return $this->belongsTo('App\Initiative');
    }
}
