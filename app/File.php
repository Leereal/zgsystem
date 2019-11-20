<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
	use SoftDeletes;
    protected $guarded = [];

     //Payments Relationship	
	public function client()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Client::class);
	}	
}
