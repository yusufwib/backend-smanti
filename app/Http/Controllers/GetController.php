<?php

namespace App\Http\Controllers;

use App\Kontak;
use App\visitor;
use Illuminate\Http\Request;
use App\posting;
use App\jadwal;
use App\gallery;
class GetController extends Controller
{
    public function indexPosting()
    {
        $posted = posting::get();
        return response()->json($posted);
    }
    public function indexGallery()
    {
        $posted = gallery::get();
        return response()->json($posted);
    }
    public function indexJadwal()
    {
        $posted = jadwal::get();
        return response()->json($posted);
    }
    public function indexKontak()
    {
        $posted = Kontak::get();
        return response()->json($posted);
    }
    public function indexVisitor()
    {
        $visitorTraffic = visitor::selectRaw('Date(created_at) as date, count(*) as visitor' )
            ->where('created_at', '>=', \Carbon\Carbon::now()->subMonth()->toDateString())
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->limit(7)
            ->get();

        return response()->json($visitorTraffic);

    }
}
