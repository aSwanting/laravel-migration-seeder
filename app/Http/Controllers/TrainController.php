<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;

class TrainController extends Controller
{
    public function fetchTrains()
    {
        $trains = Train::wheredate('departure_date', today())->get();
        return view('home', compact('trains'));
    }
}
