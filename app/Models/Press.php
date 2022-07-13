<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
    use HasFactory;
    protected $table="press";
    public $timestamps = true;

    protected $fillable = [
        "article_name","times_name","date", "poster_name","article", "created_at", "updated_at"
    ];
}
