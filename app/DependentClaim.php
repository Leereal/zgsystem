<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DependentClaim extends Model
{
    //Dependent Relationship
	public function dependent()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Dependent::class);
	}
}
