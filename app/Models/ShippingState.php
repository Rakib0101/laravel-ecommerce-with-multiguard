<?php

namespace App\Models;

use App\Models\ShippingDistrict;
use App\Models\ShippingDivision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingState extends Model
{
    use HasFactory;
    
    protected $guarded= []; 
    
    public function division()
    {
        return $this->belongsTo(ShippingDivision::class, 'division_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(ShippingDistrict::class, 'district_id', 'id');
    }
}
