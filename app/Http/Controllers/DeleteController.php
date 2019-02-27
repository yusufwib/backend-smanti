<?php

namespace App\Http\Controllers;

use App\posting;
use Illuminate\Http\Request;
//use App\posting;
use App\jadwal;
use App\gallery;

class DeleteController extends Controller
{
    public function deletePosting($id)
    {
        posting::where('id',$id)->delete();
        return "sukses";
    }

    public function deleteGallery($id)
    {
        gallery::where('id',$id)->delete();
        return "sukses";
    }
}
