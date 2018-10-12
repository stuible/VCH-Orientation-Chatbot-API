<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Slot;
use App\Intent;
use App\Http\Resources\Slot as SlotResource;
use App\Http\Resources\Intent as IntentResource;

class SlotController extends Controller
{
    public function index($intentName)
    {
        // Get all Intents
        // $slots = new Slot;
        // echo "<p class='lmao'> $slots </p>";

        $intent = Intent::where('name', $intentName)->first();

        $slots = Slot::paginate(5000);

        $slots = $slots->where('intentID', $intent['id']);

        return SlotResource::collection($slots);
    }

    public function store(Request $request, $intent)
    {
        // $slot = $request->isMethod('put') ? Slot::where('name', $intentName)->first() : new Slot;

        $intent = Intent::where('name', $intent)->first();

        $slot = new Slot;

        $slot->id = $request->input('id');
        $slot->title = $request->input('title');
        $slot->response = $request->input('response');
        $slot->intentID = $intent['id'];

        if($slot->save()){
            return new SlotResource($slot);
        }
    }

}
