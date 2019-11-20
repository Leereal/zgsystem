<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimCharge extends Model
{
    use SoftDeletes;
    //Claim Relationship
     public function claim()
    {
        return $this->belongsTo(Claim::class);
    }


}
