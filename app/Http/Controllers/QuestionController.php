<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($questionnaireName)
    {
        $questionEntered = 1;

        $questionnaire = Questionnaire::where('name', $questionnaireName)->get()->first();
        
        if(count($questionnaire->questions) <= 0){
            $questionEntered = null;
        }
        $questions = Question::orderBy('id')->get();
        return view('questionnaire.questions', compact('questionnaire', 'questions', 'questionEntered'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $questionCount = count($request->all()) - 2;
        if($questionCount <= 0){
            return redirect()->back()->with('error', 'Je hebt geen vragen geselecteerd'); 
        }

        $questionnaire = Questionnaire::where('id', $request->questionnaire_id)->get()->first();

        foreach($request->questions as $question){
            $questionnaire = Questionnaire::find($request->questionnaire_id);
            $question = Question::find($question);
            $questionnaire->questions()->attach($question);
        }

        $questionnaireName = $questionnaire->name;
        return redirect()->route('questions.questionnaire', compact('questionnaireName'));   

        
    }

    /**
     * Display the specified resource.
     */
    public function show(question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, question $question)
    {

        $questionCount = count($request->all()) - 2;
        if($questionCount <= 0){
            return redirect()->back()->with('error', 'Je hebt geen vragen geselecteerd'); 
        }
        
        // Alle vragen verwijderen
        $questionnaire = Questionnaire::where('id', $request->questionnaire_id)->get()->first();
        $questionnaire->questions()->detach();

        foreach($request->questions as $question){
            $questionnaire = Questionnaire::find($request->questionnaire_id);
            $question = Question::find($question);
            $questionnaire->questions()->attach($question);
        }

        if($request->input('action') == "next"){
            $questionnaireName = $questionnaire->name;
            return redirect()->route('questions.questionnaire', compact('questionnaireName'));   
        }else{
            $questionnaireName = $questionnaire->name;
            return redirect()->route('deceased.questionnaire', compact('questionnaireName'));
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(question $question)
    {
        //
    }

        /**
     * Create a question.
     */
    public function questionStore(Request $request){
        // dd($request->all());
        if(Question::where('question', $request->question)->exists()){
            return redirect()->back()->with('error', 'Deze vraag bestaat al');   
        }

        $request->validate([
            'question' => 'required|min:3',
        ]);

        Question::create([
            'question' => $request->question,
            
        ]);

        return redirect()->route('questions.questionnaire')->with('succes', 'De vraag is succesvol aangemaakt'); 
    }

    /**
     * Show a question dashboard.
     */
    public function questionDashboard(){
        $questions = Question::orderBy('id')->get(); 
        return view('questions.index', compact('questions'));

    }


    /**
     * Update a question.
     */
    public function questionUpdate(Request $request, question $question){
        dd($request->all());
    }
}
