<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{
    use SoftDeletes;
    protected $guarded=[];

     //Categories Relationship
    public function categories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->belongsToMany(Category::class);
    }
}
