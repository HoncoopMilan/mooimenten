<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Photo;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->admin == 1){
            $questionnaires = Questionnaire::orderBy('id', 'desc')->get();
            return view('questionnaire.index', compact('questionnaires'));
        }else if(Auth::user()->company_id != null){
            $questionnaires = Questionnaire::where('company_id', Auth::user()->company_id)->orderBy('id', 'desc')->get();
            return view('questionnaire.index', compact('questionnaires'));
        }
    }

    /**
     * Everything is filled in.
     */
    public function filledin($questionnaireName)
    {
        $questionnaire = Questionnaire::where('name', $questionnaireName)->get()->first();
        return view('questionnaire.filledin', compact('questionnaire'));
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

        $faker = \Faker\Factory::create('nl_NL');

        if(Auth::user()->company_id != null){
            Questionnaire::create([
                'name' => $request->name,
                'deceased_id' => null,
                'expire' => now()->addMinutes(65),
                'customer_code' => $faker->regexify('[A-Z]{5}[0-4]{3}'),
                'company_id' => Auth::user()->company_id
            ]);
        }else{
            Questionnaire::create([
                'name' => $request->name,
                'deceased_id' => null,
                'expire' => now()->addMinutes(65),
                'customer_code' => $faker->regexify('[A-Z]{5}[0-4]{3}')
            ]);
        }

        
        return redirect()->route('questionnaire.index')->with('succes', 'De vragenlijst is succesvol aangemaakt');   

    }

    /**
     * Display the specified resource.
     */
    public function show(string $questionnaireName)
    {
        $questionnaire = Questionnaire::where('name', $questionnaireName)->where('expire', '>', now()->addHours(1))->get()->first();

        if ($questionnaire == null) {
            return view('404'); 
        }

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
