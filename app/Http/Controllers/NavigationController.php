<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Navigation;

class NavigationController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //
        $navigation =Navigation::all();
        return $this -> returnData('Data',$navigation,'done');

    }

    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'navigation' => 'required',
        ]);

        if ($validator->fails()) {
            return $this -> returnError('','no data entered');
        }
        $show = Navigation::create($data);
        return $this -> returnSuccessMsg('200','created');
    }

    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'navigation' => 'required',
        ]);

        if ($validator->fails()) {
            return $this -> returnError('','no data entered');
        }

        $navigation = Navigation::find($id);
        if(!$navigation){
            return $this->returnError('404'," doesn't exist");
        }else{

        if($navigation->update($data)){

            return $this -> returnSuccessMsg('200','updated');
        }else{

            return $this -> returnError('','Data not updated');

        }
        }
    }

    public function destroy($id)
    {
        //
         $navigation= Navigation::find($id);
         if(!$navigation){
             return $this->returnError('404',"doesn't exist");
         }else{
         $navigation->delete();
         return $this-> returnSuccessMsg(200,'deleted');
         }
    }
}
