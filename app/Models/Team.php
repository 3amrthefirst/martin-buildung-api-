<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table="team";
    public $timestamps = true;

    protected $fillable = ["name","job_name","description", "file_path", "created_at", "updated_at"];
}
