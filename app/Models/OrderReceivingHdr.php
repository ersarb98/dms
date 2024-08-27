<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderReceivingHdr extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 't_order_receiving_hdr';

    protected $fillable = [
        'order_number',
        'tipe_dokumen',
        'nomor_dokumen',
        'tanggal_dokumen',
        'pengirim',
        'shipping_line',
        'voyage',
        'vessel',
        'asal',
        'moda',
        'waktu_gate_in',
        'catatan',
        'status'
    ];
    public function containers()
    {
        return $this->hasMany(OrderReceivingDtl::class, 'order_receiving_hdr_id');
    }

    protected $dates = ['tanggal_dokumen', 'waktu_gate_in'];
}
