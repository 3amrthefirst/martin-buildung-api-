<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Project;

class projectController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        //
        $data = Project::with(["category.gallery"])->get();
        return $this->returnData('data',$data,'done');

    }



    public function store(Request $request)
    {
        //
        $data = $request->all();
        $validator = Validator()->make($request->all(),[
            'project_category_id' =>'required',
            'name' => 'required',
            'city' => 'required',
            'year' => 'required',
            'title' => 'required',
            'details' => 'required',
            'project_gallery_id' => 'required',
        ]);
        if($validator->fails()){
             return $this->returnError('404','no data entered');
        }
        $show = Project::create($data);
        return $this->returnSuccessMsg('200','created');

    }


    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $validator = Validator()->make($request->all(),[
            'name' => 'required',
            'city' => 'required',
            'year' => 'required',
            'title' => 'required',
            'details' => 'required',
        ]);

        if($validator->fails()){
            $this->returnError('404','no data entered');
        }
        $project = Project::find($id);
        if(!$project){
            return $this->returnError('404',"Doesn't exist");
        }else{
        if ($project->update($data)){
            return $this->returnSuccessMsg('200','updated');
        }else{
            return  $this->returnError('','');
        }
        }
    }


    public function destroy($id)
    {
        //
        $project = Project::find($id);
        if (!$project){
            return $this->returnError('404',"Doesn't exist");
        }else{
            $project->delete();
            return $this->returnSuccessMsg('200','deleted');
        }
    }
}
