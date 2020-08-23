<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'job_title', 'address', 'bank_acc_no', 'cell_no'];
}
