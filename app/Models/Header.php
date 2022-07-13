<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    protected  $table = "headers";
    public $timestamps =true;
    protected $fillable =["heading","title","paragraph","header_img","created_at","updated_at"];
}
