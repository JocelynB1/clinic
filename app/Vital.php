<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class Vital extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $guarded = ['id'];
    protected $appends = ['patient_id','name'];

    public function patients()
    {
        return $this->belongsToMany('App\Patient')->withPivot('has_seen_doctor?')->withTimestamps();
    }
    public function getPatientIdAttribute()
    {
        $vitalId = $this->id;
        $patientId = DB::table("patient_vital")->where('vital_id', $vitalId)->value("patient_id");

        return Patient::find($patientId)->id;
    }
    public function getNameAttribute()
    {
        $vitalId = $this->id;
        $patientId = DB::table("patient_vital")->where('vital_id', $vitalId)->value("patient_id");

        return Patient::find($patientId)->name;
    }
    
}
