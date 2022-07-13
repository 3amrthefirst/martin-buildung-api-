<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //
        $data = Availability::with('feature','gallery')->get();
        return $this->returnData('data',$data,'done');

    }

    public function store(Request $request)
    {
        //
        $data = $request->all();
        $validator = Validator()->make($request->all(),[
            'name' => 'required',
            'street' => 'required',
            'units' => 'required',
            'place' => 'required',
            'price' => 'required',
            'details' => 'required',
        ]);
        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }
        $show = Availability::create($data);
        return $this->returnSuccessMsg('200','created');
    }

    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $validator = Validator()->make($request->all(),[
            'name' => 'required',
            'street' => 'required',
            'units' => 'required',
            'place' => 'required',
            'price' => 'required',
            'details' => 'required',
        ]);

        if($validator->fails()){
            $this->returnError('404','no data entered');
        }
        $availability = Availability::find($id);
        if(!$availability){
            return $this->returnError('404',"Doesn't exist");
        }else{
            if ($availability->update($data)){
                return $this->returnSuccessMsg('200','updated');
            }else{
                return  $this->returnError('','');
            }
        }
    }

    public function destroy($id)
    {
        //
        $availability = Availability::find($id);
        if (!$availability){
            return $this->returnError('404',"Doesn't exist");
        }else{
            $availability->delete();
            return $this->returnSuccessMsg('200','deleted');
        }
    }
}
