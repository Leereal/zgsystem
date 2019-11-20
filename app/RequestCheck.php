<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestCheck extends Model
{
	use SoftDeletes;

	protected $guarded = [];

    //Request Relationship
	public function service_provider()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(ServiceProvider::class);
	}

	 //Client Relationship
	public function client()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Client::class);
	}

	 //Dependent Relationship
	public function dependent()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Dependent::class);
	}
}
