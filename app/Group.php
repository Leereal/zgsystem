<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use SoftDeletes;
	protected $guarded = [];

	 //Clients Relationship
	public function client()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Client::class);
	}

	//SoftDelete and Restore Childs of this model using foreign key
	protected static function boot() {
    parent::boot();

    	//For clients
	    static::deleting(function($group) {
	        $group->client()->delete();
	    });
	    static::restoring(function($group) {
	        $group->client()->restore();
	    });

	}
}
