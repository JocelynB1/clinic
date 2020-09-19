<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lab extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $guarded = ['id'];
    //    protected $appends = ['number_of_beneficiaries'];
    public function patients()
    {
        return $this->belongsToMany('App\Patient')->withTimestamps();
    }
}
