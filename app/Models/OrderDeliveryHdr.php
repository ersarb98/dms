<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeliveryHdr extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 't_order_delivery_hdr';

    public function orderDeliveryDtl()
    {
        return $this->hasMany(OrderDeliveryDtl::class, 'order_id', 'id');
    }

    // Define the primary key, if it's not 'id'
    protected $primaryKey = 'id';

    // Define the fillable fields
    protected $fillable = [
        'order_number', 
        'release_time', 
        'document_type', 
        'document_number', 
        'document_date', 
        'truck_type', 
        'license_plate', 
        'destination', 
        'notes',
        'FL_STATUS'
    ];

    // Define the relationship with OrderDeliveryDtl
    public function containers()
    {
        return $this->hasMany(OrderDeliveryDtl::class, 'order_id', 'id');
    }
}
