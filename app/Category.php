<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

	protected $guarded = [];

	 //Tariffs Relationship
    public function tariffs()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->belongsToMany(Tariff::class);
    }
}
