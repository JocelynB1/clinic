<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $appends = ['date'];
    
    protected $guarded = ['id'];
   
    public function patients()
    {
        return $this->belongsToMany('App\Patient')->withTimestamps();
    }
    public function getDateAttribute(){
        return date("d/m/Y",strtotime($this->created_at));
    }
}
