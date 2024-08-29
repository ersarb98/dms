<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOperation extends Model
{
    use SoftDeletes;

    protected $table = 't_job_operation';

    protected $fillable = [
        'id_job_container',
        'no_cont',
        'jenis_job',
        'wk_status_created',
        'lokasi_awal',
        'tier_awal',
        'lokasi_akhir',
        'tier_akhir',
        'status',
        'wk_status_done'
    ];

    public function jobContainer()
    {
        return $this->belongsTo(JobContainer::class, 'id_job_container');
    }
}
