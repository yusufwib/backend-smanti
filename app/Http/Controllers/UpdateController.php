<?php

namespace App\Http\Controllers;

use App\posting;
use Illuminate\Http\Request;
//use App\posting;
use App\jadwal;
use App\gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UpdateController extends Controller
{

    public  function  __construct()
    {
        $this->middleware('jwt.auth');
    }


    public function updatePosting(Request $request,$id) {

        $photo = $request->file('featuredImage');
        $filename = $photo->getFilename().'.'.$photo->getClientOriginalExtension();
        Storage::disk('posting')->put($filename,File::get($photo));

        $json= posting::where('id',$id)->update([
            'title' => $request->input('title'),
            'featuredImage' => $filename,
            'featuredText' => $request->input('featuredText'),
            'text' => $request->input('text'),
            'typeText' => $request->input('typeText'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json($json,200);
//        $request->session()->flash('notification','insertDataSuccess')

    }



    public function updateJadwal(Request $request,$id) {

        $photo = $request->file('featuredJadwal');
        $filename = $photo->getFilename().'.'.$photo->getClientOriginalExtension();
        Storage::disk('jadwal')->put($filename,File::get($photo));
//      ANAS BAPAKE AKU
        $json= jadwal::where('id',$id)->update([
            'featuredJadwal' => $filename,
            'textField' => $request->input('textField'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json($json,200);
//        $request->session()->flash('notification','insertDataSuccess')

    }
}
