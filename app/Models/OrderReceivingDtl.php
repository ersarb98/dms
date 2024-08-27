<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReceivingDtl extends Model
{
    use HasFactory;
    protected $table = 't_order_receiving_dtl';

    protected $fillable = [
        'order_receiving_hdr_id',
        'no_cont',
        'type',
        'size'
    ];

    public function orderReceivingHdr()
    {
        return $this->belongsTo(OrderReceivingHdr::class, 'order_receiving_hdr_id');
    }
}
