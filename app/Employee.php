<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use SoftDeletes;

class Employee extends Model
{
    
    // protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'last_name', 'document', 'email', 'position', 'area', 'salary'];
}
