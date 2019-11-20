<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaitingPeriod extends Model
{
   use SoftDeletes;

	//Dependent Relationship
	public function dependent()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Dependent::class,'client_medical_aid_number','medical_aid_number');
	}

	//Client Relationship
	public function client()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Client::class,'client_medical_aid_number','medical_aid_number');
	}
}
