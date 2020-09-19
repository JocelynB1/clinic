<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabPatient extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $guarded = ['id'];
    protected $appends = ['name'];
    protected $table = 'lab_patient';
    
    public function patient()
    {
        return $this->hasOne('App\Patient');
    }
    public function lab()
    {
        return $this->hasOne('App\Lab');
    }
    public function getNameAttribute()
    {
        return Patient::find($this->patient_id)->name;
    }
}
