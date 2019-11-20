<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependent extends Model
{
	use SoftDeletes;
    //Client Relationship
	public function client()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Client::class);
	}

	//Branch Relationship
	public function branch()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Branch::class);
	}

	//Plan Relationship
	public function plan()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Plan::class);
	}

	//Limit Relationship
	public function limit()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasOne(Limit::class,'client_medical_aid_number','medical_aid_number');
	}

	//Waiting Period Relationship
	public function waiting_period()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasOne(WaitingPeriod::class,'client_medical_aid_number','medical_aid_number');
	}

	//Dependent Claim  Relationship
	public function dependent_claims()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(DependentClaim::class);
	}

	public function getPeriodStatusAttribute($attribute)
    {
        return[
            0 => 'Invalid',
            1 => 'Stage 1',
            2 => 'Stage 2',
            3 => 'Stage 3',
            4 => 'Stage 4',
            5 => 'Complete',
        ][$attribute];

    }

    public function getMembershipStatusAttribute($attribute)
    {
        return[
            0 => 'Invalid',
            1 => 'Active',
            2 => 'Lapsed',
            3 => 'Banned',
            4 => 'Premium not up-to date'            
        ][$attribute];

    }

    //SoftDelete and Restore Childs of this model using foreign key
	protected static function boot() {
    parent::boot();
    	
	    //For Claims
	    static::deleting(function($dependent) {
	        $dependent->dependent_claims()->delete();
	    });
	    static::restoring(function($dependent) {
	        $dependent->dependent_claims()->restore();
	    });

	    //For Limits
	    static::deleting(function($dependent) {
	        $dependent->limit()->delete();
	    });
	    static::restoring(function($dependent) {
	        $dependent->limit()->restore();
	    });

	    //For WaitingPeriods
	    static::deleting(function($dependent) {
	        $dependent->waiting_period()->delete();
	    });
	    static::restoring(function($dependent) {
	        $dependent->waiting_period()->restore();
	    });
	    
	}

}