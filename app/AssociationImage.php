<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssociationImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'association_id',
        'name',
        'url',
        'size',
    ];


    /**
     * Get the association that owns the images.
     */
    public function association()
    {
        return $this->belongsTo('App\Association');
    }
}
