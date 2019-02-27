<?php

namespace App\Http\Controllers;

use App\Kontak;
use App\Visitor;
use Illuminate\Http\Request;
use App\posting;
use App\jadwal;
use App\gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class PostingController extends Controller
{

    public  function  __construct()
    {
        $this->middleware(
            'jwt.auth',
            ['except' => ['storeKontak','storeVisitor']]);
    }

    public function storePosting(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'featuredImage' => 'required',
            'featuredText' => 'required',
            'text' => 'required',
            'typeText' => 'required'
        ]);

        $photo = $request->file('featuredImage');
            $filename = $photo->getFilename().'.'.$photo->getClientOriginalExtension();
            Storage::disk('posting')->put($filename,File::get($photo));

        $json= posting::insert([
           'title' => $request->input('title'),
           'featuredImage' => $filename,
           'featuredText' => $request->input('featuredText'),
           'text' => $request->input('text'),
           'typeText' => $request->input('typeText'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
            return response()->json($json,200);
    }


    public function storeGallery(Request $request)
    {
        $request->validate([
            'textField' => 'required|max:255',
            'featuredImage' => 'required',
        ]);

        $photo = $request->file('featuredImage');
        $filename = $photo->getFilename().'.'.$photo->getClientOriginalExtension();
        Storage::disk('gallery')->put($filename,File::get($photo));

        $json= gallery::insert([
            'featuredImage' => $filename,
            'textField' => $request->input('textField'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json($json,200);
    }


    public function storeJadwal(Request $request)
    {

        $request->validate([

            'textField' => 'required|max:255',
            'featuredJadwal' => 'required',

        ]);

        $photo = $request->file('featuredJadwal');
        $filename = $photo->getFilename().'.'.$photo->getClientOriginalExtension();
        Storage::disk('jadwal')->put($filename,File::get($photo));

        $json= jadwal::insert([
            'featuredJadwal' => $filename,
            'textField' => $request->input('textField'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json($json,200);
  }

    public function storeKontak(Request $request)
    {

        $request->validate([
            'email' => 'required|max:25 5',
            'text' => 'required|max:255',
        ]);

        $json= Kontak::insert([
            'email' => $request->input('email'),
            'text' => $request->input('text'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return response()->json($json,200);
    }
    public function storeVisitor(Request $request)
    {

        Visitor::insert([
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'ip' => $_SERVER['REMOTE_ADDR']
        ]);

        $posted = Visitor::get();

        return response()->json($posted);
    }
}
