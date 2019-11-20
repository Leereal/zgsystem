<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $guarded = [];// Mass Assignment

	//Client Relationship
     public function client()
    {
        return $this->belongsTo(Client::class);
    }

    //Plan Relationship
     public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    //Branch Relationship
     public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    //Bank Relationship
     public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    //Bank Relationship
     public function mop()
    {
        return $this->belongsTo(MOP::class,'m_o_p_id');
    }
   

    //User Relationship
     public function user()
    {
        return $this->belongsTo(User::class,'m_o_p_id');
    }



   /* //Get Status Active or Inactive of Payments
    public function getStatusAttribute($attribute)
    {
        return[
            0 => 'InActive',
            1 => 'Active',
        ][$attribute];

    }*/
    
}
