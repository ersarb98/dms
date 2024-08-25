<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeliveryDtl extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 't_order_delivery_dtl';

    // Define the primary key, if it's not 'id'
    protected $primaryKey = 'id';

    // Define the fillable fields
    protected $fillable = [
        'order_id', 
        'no_cont', 
        'size', 
        'type'
    ];

    // Define the relationship with OrderDeliveryHdr
    public function order()
    {
        return $this->belongsTo(OrderDeliveryHdr::class, 'order_id', 'id');
    }
}
