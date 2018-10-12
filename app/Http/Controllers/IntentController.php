<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Intent;
use App\Http\Resources\Intent as IntentResource;

class IntentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all Intents
        $intents = Intent::paginate(50);

        return IntentResource::collection($intents);
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
    public function store(Request $intentName)
    {
        $intent = $intentName->isMethod('put') ? Intent::where('name', $intentName)->first() : new Intent;

        $intent->id = $intentName->input('id');
        $intent->name = $intentName->input('name');
        $intent->description = $intentName->input('description');

        if($intent->save()){
            return new IntentResource($intent);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($intentName)
    {

        $intent = Intent::where('name', $intentName)->first();

        return new IntentResource($intent);
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
    public function destroy($intentName)
    {
        $intent = Intent::where('name', $intentName)->first();

        if($intent->delete()){
            return new IntentResource($intent);
        }
        
    }
}
