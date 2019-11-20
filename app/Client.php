<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
	use SoftDeletes;
    protected $guarded=[];
    
    //Payment Relationship
	public function payment()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Payment::class);
	}

	 //Claims Relationship
	public function claims()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Claim::class,'medical_aid_number','medical_aid_number');
	}

	//Dependents Relationship
	public function dependents()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(Dependent::class);
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

	//User Relationship
	public function user()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(User::class);
	}

	//Group Relationship
	public function group()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Group::class);
	} 

	//Branch Relationship
	public function branch()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->belongsTo(Branch::class);
	}

	 //Files Relationship	
	public function files()
	{
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
		return $this->hasMany(File::class);
	}	     


	//SoftDelete and Restore Childs of this model using foreign key
	protected static function boot() {
    parent::boot();

    	//For Payments
	    static::deleting(function($client) {
	        $client->payment()->delete();
	    });
	    static::restoring(function($client) {
	        $client->payment()->restore();
	    });

	    //For Claims
	    static::deleting(function($client) {
	        $client->claims()->delete();
	    });
	    static::restoring(function($client) {
	        $client->claims()->restore();
	    });

	    //For Limits
	    static::deleting(function($client) {
	        $client->limit()->delete();
	    });
	    static::restoring(function($client) {
	        $client->limit()->restore();
	    });
	    
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

     //Get Status Active or Inactive of Clients
     public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function scopeInActive($query)
    {
        return $query->where('status',0);
    }

}
