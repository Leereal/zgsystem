<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;
     //Claim Relationship
    public function users()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->belongsToMany(User::class);
    }
}
