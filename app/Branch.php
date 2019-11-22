<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
	use SoftDeletes;
   //User Relationship
	public function user()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(User::class);
	}

	//Claim Relationship
	public function claim()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Claim::class);
	}

	//Client Relationship
	public function clients()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Client::class);
	}

    //Client Relationship
	public function dependents()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Dependent::class);
	}

    //ServiceProvider Relationship
	public function serviceprovider()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(ServiceProvider::class);
	}

     //Payments Relationship
	public function payment()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Payment::class);
	}


	//SoftDelete and Restore Childs of this model using foreign key
	protected static function boot() {
    parent::boot();

    	//For users
	    static::deleting(function($branch) {
	        $branch->user()->delete();
	    });
	    static::restoring(function($branch) {
	        $branch->user()->restore();
	    });

	    //For clients
	    static::deleting(function($branch) {
	        $branch->clients()->delete();
	    });
	    static::restoring(function($branch) {
	        $branch->clients()->restore();
	    });

	    //For claims
	    static::deleting(function($branch) {
	        $branch->claim()->delete();
	    });
	    static::restoring(function($branch) {
	        $branch->claim()->restore();
	    });

	    //For Payments
        static::deleting(function($branch) {
            $user->payment()->delete();
        });
        static::restoring(function($branch) {
            $user->payment()->restore();
        });
	}

}
