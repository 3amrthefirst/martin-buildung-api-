<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCategories extends Model
{
    use HasFactory;
    protected $table="project_categories";
    public $timestamps = true;

    protected $fillable = ["name","file_path", "created_at", "updated_at"];



    public function projects(){
        return $this->hasMany('App\Models\Project','project_category_id');
    }
    public function gallery(){
        return $this->hasManyThrough(
            'App\Models\ProjectsGallery',
            'App\Models\Project',
            'project_category_id',
            'projects_id',
            'id',
            'id'
        );
    }



}
