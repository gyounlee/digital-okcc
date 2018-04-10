<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "codes";
    // Indicates if the model should be timestamped. 
    public $timestamps = false;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = false;
    
    // Relationship with code_categories table
    public function code_category() {
        return $this->belongsTo('App\Code_Category');
    }

    // Relationship with system_logs table
    public function system_logs() {
        return $this->hasMany('App\System_Log');
    }

    // Relationship with members table
    public function members() {
        return $this->hasMany('App\Member');
    }

    // Relationship with family_maps table
    public function family_maps() {
        return $this->hasMany('App\Family_Map');
    }

    // Relationship with departments table
    public function departments() {
        return $this->hasMany('App\Department');
    }

    // Relationship with member_department_maps table
    public function member_department_maps() {
        return $this->hasMany('App\Member_Department_Map');
    }
}