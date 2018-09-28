<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function show($intent, $slot)
    {
        $response = DB::table('intents')
            ->join('slots', 'intents.id', '=', 'slots.intentID')
            ->where('intents.name', '=', $intent)
            ->where('slots.title', '=', $slot)
            ->select('response')
            ->get();

        return $response;
        
    }
}
