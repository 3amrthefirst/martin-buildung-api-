<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\ProjectsGallery;

class ProjectGalleryController extends Controller
{
 use GeneralTrait;
    public function index()
    {
        //
        $data = ProjectsGallery::with(["projects.category"])->get();
        return $this->returnData('data',$data,'Done');
    }

    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'projects_id' => 'required',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }

        if ($file = $request->file('file_path')) {
            $image_name = $file->getClientOriginalName();
            $file->storeAs('images/projectGallery', $image_name);
        }
        ProjectsGallery::create([
            "projects_id" => $request->projects_id,
            "file_path" => 'storage/images/projectGallery/'.$image_name,
        ]);
        return $this->returnSuccessMsg('200','created');
    }

    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'projects_id' => 'required',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }
        $gallery = ProjectsGallery::find($id);
        if(!$gallery){
            return  $this->returnError('404',"doesn't exist");
        }else{
            if ($file = $request->file('file_path')) {
                $image_name = $file->getClientOriginalName();
                $file->storeAs('images/projectgallery', $image_name);
            }
            $update = $gallery->update([
                "projects_id" => $request->projects_id,
                "file_path" => 'storage/images/category/' . $image_name,
            ]);
        }
        if(!$update){
            return $this->returnError('','something wrong');

        }else{
            return $this->returnSuccessMsg('200','updated');
        }
    }



    public function destroy($id)
    {
        //
       $gallery= ProjectsGallery::find($id);

       if (!$gallery){
           return $this->returnError('404',"doesn't exist");
       }else{
           $gallery->delete();
        return $this->returnSuccessMsg('200','deleted');
       }
    }
}
