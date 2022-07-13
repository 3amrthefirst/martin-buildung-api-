<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\AvailabilityFeature;

class AvailabilityFeatureController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //

        $data = AvailabilityFeature::with(["availability"])->get();
        return $this->returnData('data',$data,'success');

    }

    public function store(Request $request)
    {
        //

        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'availability_id' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }

        $show = AvailabilityFeature::create($data);
        return $this->returnSuccessMsg('200','created');
    }

    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'availability_id' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }
        $availability = AvailabilityFeature::find($id);
        if(!$availability){
            return  $this->returnError('404',"dosen't exist");
        }else{
            if ($availability->update($data)){
                return $this->returnSuccessMsg('200','updated');
            }else{
                return $this->returnError('','');
            }
        }
    }

    public function destroy($id)
    {
        //

        $availability= AvailabilityFeature::find($id);

        if (!$availability){
            return $this->returnError('404',"doesn't exist");
        }else{
            $availability->delete();
            return $this->returnSuccessMsg('200','deleted');
        }
    }
}
