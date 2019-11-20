<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use SoftDeletes;
    //Branch Relationship
     public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    //ServiceProvider Relationship
     public function serviceprovider()
    {
        return $this->belongsTo(ServiceProvider::class,'service_provider_id');
    }

    //Client Relationship
     public function client()
    {
        return $this->belongsTo(Client::class,'medical_aid_number','medical_aid_number');
    }

    //Dependent Relationship
     public function dependent()
    {
        return $this->belongsTo(Dependent::class,'medical_aid_number','medical_aid_number');
    }
    

    //User Relationship
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Claim Charge Relationship
     public function claim_charges()
    {
        return $this->hasMany(ClaimCharge::class);
    }

    //SoftDelete and Restore Childs of this model using foreign key
    protected static function boot() {
    parent::boot();

        //For Payments
        static::deleting(function($claim) {
            $claim->claim_charges()->delete();
        });
        static::restoring(function($claim) {
            $claim->claim_charges()->restore();
        });
        
    }
}
