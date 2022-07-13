<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    protected $table="availabilities";
    public $timestamps = true;
    protected $fillable = ['name','street','units','place','price','details','created_at','updated_at',];

    public function feature(){
        return $this->hasMany('App\Models\AvailabilityFeature','availability_id');
    }
    public function gallery(){
        return $this->hasMany('App\Models\AvailabilityGallery','availability_id');
    }
}
