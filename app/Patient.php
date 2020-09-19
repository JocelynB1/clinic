<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $appends = ['age'];
  
    protected $guarded = ['id'];
    public function visits()
    {
        return $this->belongsToMany('App\Visit')->withTimestamps();
    }
    public function vitals()
    {
        return $this->belongsToMany('App\Vital')->withPivot('has_seen_doctor?')->withTimestamps();
    }
    public function labs()
    {
        return $this->belongsToMany('App\Lab')->withTimestamps();
    }
    public function consultations()
    {
        return $this->belongsToMany('App\Consultation')->withTimestamps();
    }
    public function getAgeAttribute()
    {
        return today()->diffInYears($this->birth_date);
    }
    /*
      public function visit()
    {
        return $this->belongsToMany('App\PatientVisit')->withTimestamps();
    }
    */
    
}
