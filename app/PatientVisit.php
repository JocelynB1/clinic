<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientVisit extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
  
    protected $guarded = ['id'];
    protected $appends = ['name'];
    protected $table = 'patient_visit';

    
    public function patient()
    {
        return $this->hasOne('App\Patient');
    }
    public function visit()
    {
        return $this->hasOne('App\Visit');
    }
    public function getNameAttribute()
    {
        return Patient::find($this->patient_id)->name;
    }
}
