<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientVital extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
   
    protected $guarded = ['id'];
    protected $appends = ['name','date','gender'];
    protected $table = 'patient_vital';
    public function patient()
    {
        return $this->hasOne('App\Patient');
    }
    public function vital()
    {
        return $this->hasOne('App\Vital');
    }
    public function getNameAttribute()
    {
        return Patient::find($this->patient_id)->name;
    }
    public function getDateAttribute(){
        return date("d/m/Y",strtotime($this->created_at));
    }
    public function getGenderAttribute()
    {
        return Patient::find($this->patient_id)->gender;
    }
 
}
