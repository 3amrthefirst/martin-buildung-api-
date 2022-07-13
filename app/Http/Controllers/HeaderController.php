<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Header;

class HeaderController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        //
         $data = Header::all();
         return $this->returnData('data',$data , 'Done');
    }


    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(),[
            'heading' => 'required',
            'title' => 'required',
            'paragraph' => 'required',
            'header_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->returnError('404','no data entered');
        }
        if ($file = $request->file('header_img')) {
            $image_name = $file->getClientOriginalName();
            $file->storeAs('images/header', $image_name);
        }
        Header::create([
            "heading" => $request->heading,
            "title" => $request->title,
            "paragraph" => $request->paragraph,
            "header_img" => 'storage/images/header/'.$image_name,
        ]);
        return $this->returnSuccessMsg('200','created');
    }


    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $validator = Validator()->make($request->all(),[
            'heading' => 'required',
            'title' => 'required',
            'paragraph' => 'required',
            'header_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()){
            return $this->returnError('404','no data entered');
        }

        $header=Header::find($id);

        if(!$header){
            return $this->returnError('404',"id doesn't exist");
        }else{
            if ($file = $request->file('header_img')) {
                $image_name = $file->getClientOriginalName();
                $file->storeAs('images/header', $image_name);
            }
            $update = $header->update([
                "heading" => $request->heading,
                "title" => $request->title,
                "paragraph" => $request->paragraph,
                "header_img" => 'storage/images/header/'.$image_name,
            ]);
        if(!$update){
            return $this->returnError('','something wrong');

        }else{
            return $this->returnSuccessMsg('200','updated');
        }
        }
    }


    public function destroy($id)
    {
        //
        $header = Header::find($id);
        if (!$header){
          return  $this->returnError('404',"dosen't exist");
        }else{
            $header->delete();
            return $this->returnSuccessMsg('200','deleted');
        }
    }
}
