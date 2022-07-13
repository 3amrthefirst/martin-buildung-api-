<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    use GeneralTrait;

    public function index()
    {

        $data = About::all();
        return $this->returnData('data',$data,'success');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator()->make($request->all(),[
           'section_title' => 'required',
           'heading' => 'required',
           'details' => 'required',
           'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($validator->fails()){
            return $this->returnError('404','no data entered');
        }else{
            if ($file = $request->file('img')) {
                $image_name = $file->getClientOriginalName();
                $file->storeAs('images/about', $image_name);
            }
            About::create([
                "section_title" => $request->section_title,
                 "heading" => $request->heading,
                 "details" => $request->details,
                 "img" => 'storage/images/about/'.$image_name,
            ]);
            return $this->returnSuccessMsg('200','created');
        }


    }

    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $id_ = About::find($id);
        $validator = Validator()->make($request->all(),[
            'section_title' => 'required',
            'heading' => 'required',
            'details' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()){
            return $this->returnError('404','no data entered');
        }
        if(!$id_){
            return $this->returnError('404',"id doesn't exist");
        }else{
            if ($file = $request->file('img')) {
                $image_name = $file->getClientOriginalName();
                $file->storeAs('images/about', $image_name);
            }
            $updated = $id_->update([
                "section_title" => $request->section_title,
                "heading" => $request->heading,
                "details" => $request->details,
                "img" => 'storage/images/about/'.$image_name,
            ]);
            if(!$updated){
                return $this->returnError('','not updated');
            }else{
               return $this->returnSuccessMsg('200','updated');
            }
        }


    }

    public function destroy($id)
    {
        //
        $id_ =About::find($id);
        if(!$id_){
            return $this->returnError('404'," id Doesn't exist");
        }else{
            $id_->delete();
            return $this->returnSuccessMsg('200','deleted');
        }
    }
}
