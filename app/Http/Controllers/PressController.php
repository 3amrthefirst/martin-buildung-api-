<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Press;


class PressController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //
        $press =Press::all();
        return $this -> returnData('press',$press,'done');

    }
    public function pressById($id)
    {
        $team =Press::all()->find($id);
        if(!$team)
            return $this -> returnError('404','not found');
        return $this -> returnData ('team',$team,'done');
    }



    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'article_name' => 'required',
            'times_name' => 'required',
            'date' => 'required',
            'poster_name' => 'required',
            'article' => 'required',
        ]);

        if ($validator->fails()) {
            return $this -> returnError('','no data entered');
        }
        $show = Press::create($data);
        return $this -> returnSuccessMsg('200','created');
    }




    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'article_name' => 'required',
            'times_name' => 'required',
            'date' => 'required',
            'poster_name' => 'required',
            'article' => 'required',
        ]);
        if ($validator->fails()) {
            return $this -> returnError('','no data enterd');
        }

        $press = Press::find($id);
        if(!$press){
            return $this->returnError('404',"Doesn't exist");
        }else{

        if($press->update($data)){

            return $this -> returnSuccessMsg('200','updated');
        }else{

            return $this -> returnError('','Data not updated');

        }
        }

    }


    public function destroy($id)
    {
        //
         $press = Press::find($id);
         if(!$press){
             return $this->returnError('404',"Doesn't exist");
         }else{
         $press->delete();
         return $this-> returnSuccessMsg(200,'deleted');
         }
    }
}
