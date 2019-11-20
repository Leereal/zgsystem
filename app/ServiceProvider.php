<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProvider extends Model
{
	use SoftDeletes;
    //Claim Relationship
	public function claim()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Claim::class);
	}

	//Dependent Claim Relationship
	public function dependent_claims()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(DependentClaim::class);
	}

	//Request Relationship
	public function request_checks()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(RequestCheck::class);
	}

	  //Categories Relationship
    public function categories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->belongsToMany(Category::class);
    }

	//SoftDelete and Restore Childs of this model using foreign key
	protected static function boot() {
    parent::boot();

    	//For Payments
	    static::deleting(function($serviceprovider) {
	        $serviceprovider->claim()->delete();
	    });
	    static::restoring(function($serviceprovider) {
	        $serviceprovider->claim()->restore();
	    });
	    
	}
}
