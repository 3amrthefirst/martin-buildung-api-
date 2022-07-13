<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Traits\GeneralTrait;

class TeamController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //

        $team =team::all();
        return $this -> returnData('team',$team,'done');

    }

    public function teamById($id)
    {
        $team =team::all()->find($id);
        if(!$team)
            return $this -> returnError('404','not found');
        return $this -> returnData ('team',$team,'done');
    }

    public function store(Request $request){
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'name' => 'required',
            'job_name' => 'required',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this -> returnError('','no data entered');
        }

        if ($file = $request->file('file_path')) {
            $image_name = $file->getClientOriginalName();
            $file->storeAs('images/team', $image_name);
        }
        Team::create([
            "name" => $request->name,
            "job_name" => $request->job_name,
            "file_path" => 'storage/images/header/'.$image_name,
            "description" => $request->description,
        ]);
        return $this -> returnSuccessMsg('200','created');

    }

    public function update(Request $request,$id)
    {
        //

        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'name' => 'required',
            'job_name' => 'required',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->returnError('', 'no data enterd');
        }

        $team = team::find($id);

        if (!$team) {
            return $this->returnError('404', "Doesn't exist");
        } else{
            if ($file = $request->file('file_path')) {
                $image_name = $file->getClientOriginalName();
                $file->storeAs('images/team', $image_name);
            }
        $update = $team->update([
            "name" => $request->name,
            "job_name" => $request->job_name,
            "file_path" => 'storage/images/header/' . $image_name,
            "description" => $request->description,
        ]);
    }
        if(!$update){
            return $this->returnError('','something wrong');

        }else{
            return $this->returnSuccessMsg('200','updated');
        }
     }




    //destroy

    public function destroy($id)
    {
        //
        $team = team::find($id);
        if(!$team){
            return  $this->returnError('404',"Doesn't exist");
        }else{
        $team->delete();
        return $this-> returnSuccessMsg("200",'deleted');
        }
    }
}
