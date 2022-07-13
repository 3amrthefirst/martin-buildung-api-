<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityFeature extends Model
{
    use HasFactory;
    protected $table ="availability_features";
    public $timestamps = true;
    protected $fillable=['availability_id','name','created_at','updated_at',];

    public function availability(){
        return $this->belongsTo('App\Models\Availability','availability_id');
    }
}
