<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsGallery extends Model
{
    use HasFactory;

    protected $table="project_gallery";
    public $timestamps = true;

    protected $fillable = [
        "projects_id",
        "file_path",
    ];

    public function category(){
        return $this->hasManyThrough(
            'App\Models\ProjectCategories',
            'App\Models\Project',
            'project_gallery_id',
            'projects_id',
            'id',
            'id'
        );
    }

    public function projects(){
        return $this->belongsTo('App\Models\Project','projects_id');
    }
}
