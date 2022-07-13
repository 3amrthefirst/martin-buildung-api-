<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\AvailabilityGallery;

class AvailabilityGalleriesController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //

        $data = AvailabilityGallery::with(["availability"])->get();
        return $this->returnData('data',$data,'success');
    }

    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'availability_id' => 'required',
            'img_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }

        if ($file = $request->file('img_path')) {
            $img_path = [];

            $image_name = $file->getClientOriginalName();
            $file->storeAs('images/AvailabilityGallery', $image_name);

        }
        AvailabilityGallery::create([
            "availability_id" => $request->availability_id,
            "img_path" => 'storage/images/AvailabilityGallery/'.$image_name,
        ]);
        return $this->returnSuccessMsg('200','created');
    }

    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(), [
            'availability_id' => 'required',
            'img_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }
        $availability = AvailabilityGallery::find($id);
        if(!$availability){
            return  $this->returnError('404',"dosen't exist");
        }else{
            if ($file = $request->file('img_path')) {
                $image_name = $file->getClientOriginalName();
                $file->storeAs('images/AvailabilityGallery', $image_name);
            }
            $update = $availability->update([
                "availability_id" => $request->availability_id,
                "img_path" => 'storage/images/AvailabilityGallery/' . $image_name,
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

        $availability= AvailabilityGallery::find($id);

        if (!$availability){
            return $this->returnError('404',"doesn't exist");
        }else{
            $availability->delete();
            return $this->returnSuccessMsg('200','deleted');
        }
    }
}
