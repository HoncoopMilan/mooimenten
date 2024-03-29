<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Photo;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check() == true && Auth::user()->admin != 0){
            $questionnaires = Questionnaire::orderBy('id', 'desc')->get();
            return view('answers.index', compact('questionnaires'));
        }
        $questionnaires = false;
        return view('answers.index', compact('questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function check(Request $request)
    {
        if(count(Questionnaire::where('customer_code', $request->customercode)->get()) > 0){
            $customercode = $request->customercode;
            return redirect()->route('answers.show', compact('customercode'));   
        }else{
            return redirect()->back()->with('error', 'Je klanten code is niet geldig');   
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->img == null){
            return redirect()->back()->with('imgError', 'Je moet 1 of meerdere afbeeldingen geselecteerd hebben');   
        }

        $person = 0;

        //Checkt of er al een antwoord is aangemaakt
        $latestAnswer = Answer::where('questionnaire_id', $request->questionnaire_id);

        if(Answer::where('questionnaire_id', $request->questionnaire_id)->first() != null){
            $latestAnswer = Answer::where('questionnaire_id', $request->questionnaire_id)->latest()->first();
            $person = $latestAnswer->person + 1;
        }

        //Checkt of alle vragen zijn ingevuld en slaat ze op
        foreach($request->questions as $question_id => $answer){
            if($answer == null){
                return redirect()->back()->with('questionError', 'Je hebt niet alle vragen ingevuld');   
            }

            Answer::create([
                'answer' => $answer,
                'questionnaire_id' => $request->questionnaire_id,
                'question_id' => $question_id,
                'person' => $person,
            ]);
        }

        foreach($request->img as $img){
            $faker = \Faker\Factory::create('nl_NL');
            $imgName = $faker->numberBetween(10000, 200000) . $img->getClientOriginalName();

            Photo::create([
                'img' => $imgName,
                'questionnaire_id' => $request->questionnaire_id,
                'person' => $person
            ]);

            $img->storeAs('public/answers', $imgName);
        }

        $questionnaire = Questionnaire::where('id', $request->questionnaire_id)->first();
        $questionnaire->completed_times = $questionnaire->completed_times + 1;
        $questionnaire->save();

        return view('questionnaire.thankyou');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $customercode)
    {
        $questionnaire = Questionnaire::where('customer_code', $customercode)->get()->first();
        if($questionnaire != null){
            $person = Answer::Where('questionnaire_id', $questionnaire->id)->latest()->first();
            if(count($questionnaire->answers) <= 0 || count($questionnaire->photos) <= 0){
                return redirect()->back()->with('error', 'Er zijn geen antwoorden mee gegeven bij deze vragenlijst');   
            }

            if(!$person){
                return redirect()->back()->with('error', 'Sorry, er is een fout opgetreden');   
            }

            $latestPerson = $person->person;
            return view('answers.show', compact('questionnaire','latestPerson'));
        }else{
            return view('404');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
