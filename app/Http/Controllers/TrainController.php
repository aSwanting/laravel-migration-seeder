<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
use Illuminate\Support\Facades\DB;

class TrainController extends Controller
{
    public function fetchTrains()
    {
        $trains = Train::where('departure_date', '>=', date('Y-m-d'))
            ->orderBy('departure_date')
            ->orderBy('departure_time')
            ->get();

        // $trains = Train::wheredate('departure_date', '>=', today())->get();
        // $trains = Train::whereDate('departure_date', 'arrival_date')->get();
        // $trains = DB::select('SELECT * FROM `trains` WHERE `departure_date` = `arrival_date`');

        return view('home', compact('trains'));
    }
}
