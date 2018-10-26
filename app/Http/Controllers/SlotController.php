<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Slot;
use App\Intent;
use App\Synonym;
use App\Http\Resources\Slot as SlotResource;
use App\Http\Resources\Intent as IntentResource;
use App\Http\Resources\Synonym as SynonymResource;

class SlotController extends Controller
{
    public function index($intentName)
    {
        // Get all Intents

        $intent = Intent::where('name', $intentName)->first();

        $slots = Slot::paginate(5000);

        $slots = $slots->where('intentID', $intent['id']);

        return SlotResource::collection($slots);
    }

    public function show($intentName, $slotName)
    {
        // Get single Intent

        $intent = Intent::where('name', $intentName)->first();

        $slots = Slot::paginate(5000);

        $slots = $slots->where('intentID', $intent['id'])->where('title', $slotName);

        if(count($slots) > 0){
            return SlotResource::collection($slots);
        }
        else {
            // $synonym = Synonym::where('text', $slotName)->first();

            // $slots = Slot::with('synonyms')->get();
            // $slots = $slots->where('id', $synonym['slotID'])->where('intentID', $intent['id']);
            // $slots = Slot::where('intentID', $intent['id']);
            $synonym = Synonym::with('slot')->get()->where('slot.intentID', $intent['id'])->where('text', $slotName);
            // echo $synonym;
            return SlotResource::collection($synonym);
        }

        // $synonyms = Synonym::where('slotID', $slots['id'])->first();
        // echo $slots;
        // return $synonyms;

        
    }

    public function store(Request $request, $intent)
    {
        // $slot = $request->isMethod('put') ? Slot::where('name', $intentName)->first() : new Slot;

        $intent = Intent::where('name', $intent)->first();

        $slot = $request->isMethod('put') ? Slot::findOrFail($request->input('id')) : new Slot;

        $slot->id = $request->input('id');
        $slot->title = $request->input('title');
        $slot->response = $request->input('response');
        $slot->intentID = $intent['id'];

        if($slot->save()){
            return new SlotResource($slot);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($intentName, $slotName)
    {
        $intent = Intent::where('name', $intentName)->first();

        $slot = Slot::where('title', $slotName)->where('intentID', $intent['id'])->first();

        if($slot->delete()){
            return new SynonymResource($slot);
        }
        
    }

}
