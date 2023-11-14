<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class DeceasedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($questionnaireName)
    {
        $questionnaire = Questionnaire::where('name', $questionnaireName)->get()->first();
        if($questionnaire->deceased_id == null){
            $deceased = null;
        }
        else{
            $deceased = Deceased::where('id',$questionnaire->deceased_id)->get()->first();
        };
        return view('questionnaire.deceased', compact('questionnaire', 'deceased'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'zipcode' => 'required',
            'city' => 'required',
            'adress' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_death' => 'required|date',
            'img' => 'required'
        ]);

        $deceased = Deceased::create([
            'name' => $request->name,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'adress' => $request->adress,
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'img' => 'test'
        ]);

        $questionnaire = Questionnaire::where('id', $request->questionnaire_id)->get()->first();
        $questionnaire->deceased_id = $deceased->id;
        $questionnaire->save();

        $questionnaireName = $questionnaire->name;
        return redirect()->route('deceased.questionnaire', compact('questionnaireName'));   
    }

    /**
     * Display the specified resource.
     */
    public function show(deceased $deceased)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(deceased $deceased)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, deceased $deceased)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(deceased $deceased)
    {
        //
    }
}
