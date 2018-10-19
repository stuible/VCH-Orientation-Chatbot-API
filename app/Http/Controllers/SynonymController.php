<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slot;
use App\Intent;
use App\Synonym;
use App\Http\Resources\Slot as SlotResource;
use App\Http\Resources\Intent as IntentResource;
use App\Http\Resources\Synonym as SynonymResource;


class SynonymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($intentName, $slotName)
    {
        $intent = Intent::where('name', $intentName)->first();

        $slot = Slot::where('title', $slotName)->where('intentID', $intent['id'])->first();

        $synonyms = Synonym::paginate(5000);

        $synonyms = $synonyms->where('slotID', $slot['id']);

        return SynonymResource::collection($synonyms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
