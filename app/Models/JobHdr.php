<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobHdr extends Model
{
    use SoftDeletes;

    protected $table = 't_job_hdr';

    protected $fillable = [
        'jenis',
        'nomor_order',
        'status'
    ];

    public function containers()
    {
        return $this->hasMany(JobContainer::class, 'id_job_hdr');
    }
}
