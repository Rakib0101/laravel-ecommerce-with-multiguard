<?php

namespace App\Models;

use App\Models\User;
use App\Models\ShippingState;
use App\Models\ShippingDistrict;
use App\Models\ShippingDivision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function division(){
    	return $this->belongsTo(ShippingDivision::class,'division_id','id');
    }

      public function district(){
    	return $this->belongsTo(ShippingDistrict::class,'district_id','id');
    }

      public function state(){
    	return $this->belongsTo(ShippingState::class,'state_id','id');
    }

      public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }
}
