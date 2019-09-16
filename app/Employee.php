<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'last_name', 'document', 'email', 'position', 'area', 'salary'];
}
