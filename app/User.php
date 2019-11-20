<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //Branch Relationship
     public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    //Claim Relationship
    public function claim()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->hasMany(Claim::class);
    }

     //Roles Relationship
    public function roles()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->belongsToMany(Role::class);
    }

    //UserProfile Relationship
    public function userprofile()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->hasOne(Role::class);
    }

      //Roles Helpers    
     
     public function hasRole($role)
    {
        return $this->roles()->whereIn('name',$role)->exists();
    } 

     //Claim Relationship
    public function client()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->hasMany(Client::class);
    }

    public function payments()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = client_id, localKey = id)
        return $this->hasMany(Payment::class);
    }



    // //SoftDelete and Restore Childs of this model using foreign key
    // protected static function boot() {
    // parent::boot();

    //     //For Payments
    //     static::deleting(function($user) {
    //         $user->userprofile()->delete();
    //     });
    //     static::restoring(function($user) {
    //         $user->userprofile()->restore();
    //     });       
        
    // }
    

    //  public function hasAnyRole($role)
    // {
      
        //return null !== $this->roles()->whereIn('name',$role)->first();
        
    // }

    //  //Get Status Active or Inactive of Payments
    // public function getStatusAttribute($attribute)
    // {
    //     return[
    //         0 => 'unchecked',
    //         1 => 'checked',
    //     ][$attribute];

    // }

    // // public function scopeActive($query)
    // {
    //     return $query->where('active',1);
    // }

    // public function scopeInActive($query)
    // {
    //     return $query->where('active',0);
    // }



}
