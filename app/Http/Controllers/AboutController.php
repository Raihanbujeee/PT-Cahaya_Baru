<?php

namespace App\Http\Controllers;
use App\Models\AboutContents;
use App\Models\CoreValues;
use App\Models\CompanyStats;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('tentang', [
            'about'      => AboutContents::first(), // Data Hero
            'stats'      => CompanyStats::all(),    // Data Statistik
            'coreValues' => CoreValues::all(),      // Data Nilai Inti
        ]);
    }
}
