<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    public $timestamps = false; 
    protected $table = 'job_status';
    protected $primaryKey = 'recnum';
    protected $guarded = [];


}
