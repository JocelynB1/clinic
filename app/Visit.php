<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
   
    protected $guarded = ['id'];
    //protected $appends = ['name'];
    public function patients()
    {
        return $this->belongsToMany('App\Patient')->withTimestamps();
    }
    // public function getNameAttribute()
    // {
    //     $visitId = $this->id;
    //     $patientId = DB::table("patient_visit")->where('visit_id', $visitId)->value("patient_id");

    //     return Patient::find($patientId)->name;
    // }
}
