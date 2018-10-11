<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Slot;
use App\Http\Resources\Slot as SlotResource;

class SlotController extends Controller
{
    public function index($intent)
    {
        // Get all Intents
        // $slots = new Slot;
        // echo "<p class='lmao'> $slots </p>";
        $slots = Slot::paginate(5000);

        $slots = $slots->where('intentID', 1);

        return SlotResource::collection($slots);
    }

    // public function show($intent, $slot)
    // {
    //     $response = DB::table('intents')
    //         ->join('slots', 'intents.id', '=', 'slots.intentID')
    //         ->where('intents.name', '=', $intent)
    //         ->where('slots.title', '=', $slot)
    //         ->select('response')
    //         ->get();

    //     return $response;
    // }
}
