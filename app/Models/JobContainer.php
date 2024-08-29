<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobContainer extends Model
{
    use SoftDeletes;

    protected $table = 't_job_container';

    protected $fillable = [
        'id_job_hdr',
        'no_cont',
        'size',
        'type_cont'
    ];

    public function jobHdr()
    {
        return $this->belongsTo(JobHdr::class, 'id_job_hdr');
    }

    public function operations()
    {
        return $this->hasMany(JobOperation::class, 'id_job_container');
    }
}
