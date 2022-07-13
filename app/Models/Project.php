<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table="projects";
    public $timestamps = true;

    protected $fillable = [
        "project_category_id",
        "name",
        "city",
        "year",
        "title",
        "details",
        "project_gallery_id",
        "created_at",
        "updated_at",
    ];

    public function category(){
        return $this->belongsTo('App\Models\ProjectCategories','project_category_id');
    }

    public function gallery(){
      return $this->hasMany('App\Models\ProjectsGallery','projects_id');
    }

}
