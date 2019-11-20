<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
	use SoftDeletes;

	protected $guarded = [];
	
     //Payments Relationship	
	public function payments()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Payment::class);
	}	
}
