<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    protected $table="navigations";
    public $timestamps = true;

    protected $fillable = ["navigation", "created_at", "updated_at"];
}
