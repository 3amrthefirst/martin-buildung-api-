<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\ProjectCategories;

class projectCategoriesController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //
        $data = ProjectCategories::with(["projects.gallery"])->get();
        return $this->returnData('data',$data,'Done');
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'name' => 'required',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }

        if ($file = $request->file('file_path')) {
            $image_name = $file->getClientOriginalName();
            $file->storeAs('images/category', $image_name);
        }
        ProjectCategories::create([
            "name" => $request->name,
            "file_path" => 'storage/images/category/'.$image_name,
        ]);
        return $this->returnSuccessMsg('200','created');
    }


    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(),[
           'name' => 'required',
           'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()){
            return $this->returnError('404','no data entered');
        }
        $category = ProjectCategories::find($id);
        if(!$category){
            return $this->returnError('404',"Doesn't exist");
        }else{
            if ($file = $request->file('file_path')) {
                $image_name = $file->getClientOriginalName();
                $file->storeAs('images/category', $image_name);
            }
            $update = $category->update([
                "name" => $request->name,
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
        $category = ProjectCategories::find($id);
        if(!$category){
            return $this->returnError('404',"Doesn't exist");
        }else{
            $category->delete();
           return $this->returnSuccessMsg('200','deleted');
        }
    }
}
