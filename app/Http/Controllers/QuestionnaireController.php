<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionnaires = Questionnaire::orderBy('id', 'desc')->get();
        return view('questionnaire.index', compact('questionnaires'));
    }

    /**
     * Deceased step from the form.
     */
    public function deceased()
    {
        return 'test';
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
        if(Questionnaire::where('name', $request->name)->exists()){
            return redirect()->back()->with('error', 'De naam bestaat al');   
        }

        $request->validate([
            'name' => 'required|min:3',
        ]);

        Questionnaire::create([
            'name' => $request->name,
            'deceased_id' => null,
        ]);

        return redirect()->route('questionnaire.index')->with('succes', 'De vragenlijst is succesvol aangemaakt');   

    }
    /**
     * Save the questionnaire.
     */
    public function storeQuestionnaire(Request $request){
        if($request->img == null){
            return redirect()->back()->with('imgError', 'Je moet 1 of meerdere afbeeldingen geselecteerd hebben');   
        }

        foreach($request->questions as $question){
            if($question == null){
                return redirect()->back()->with('questionError', 'Je hebt niet alle vragen ingevuld');   
            }
        }

        foreach($request->img as $img){
            $faker = \Faker\Factory::create('nl_NL');
            $imgName = $faker->numberBetween(10000, 200000) . $img->getClientOriginalName();

            Photo::create([
                'img' => $imgName,
                'questionnaire_id' => $request->questionnaire_id
            ]);

            $img->storeAs('public/answers', $imgName);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $questionnaireName)
    {
        $questionnaire = Questionnaire::where('name', $questionnaireName)->get()->first();
        $photos = Photo::where('questionnaire_id', $questionnaire->id)->get();
        return view('questionnaire.show', compact('questionnaire', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
