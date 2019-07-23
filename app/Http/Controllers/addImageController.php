<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\tblImageModel;
class addImageController extends Controller
{
    public function index(){
        $images = tblImageModel::all();
        return view('addimage', compact('images'));
    }
    public function upload(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        if($validator->fails()){
            return redirect('index')->withErrors($validator)->withInput();
        }else{
            $image = $request->file('image');
            $extension_image = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extension_image, File::get($image));

            $tbl_image = new tblImageModel;
            $tbl_image->name = $request->input('name');
            $tbl_image->image = $image->getFilename().'.'.$extension_image;
            $tbl_image->save(); 

            return redirect('index');
        }

    }
}
