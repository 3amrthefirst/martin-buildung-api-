<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table="abouts";
    public $timestamps=true;
    protected $fillable =['section_title','heading','details','img','created_at','updated_at'];
}
