<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($questionnaireName)
    {
        $questionnaire = Questionnaire::where('name', $questionnaireName)->get()->first();
        
        if(Auth::user()->admin == 1 || Auth::user()->company_id == $questionnaire->company_id){
            $questionEntered = 1;

            if(count($questionnaire->questions) <= 0){
                $questionEntered = null;
            }
            $questions = Question::orderBy('id')->get();
            return view('questionnaire.questions', compact('questionnaire', 'questions', 'questionEntered'));
        }else{
            return view('404');
        }

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
        $questionnaire = Questionnaire::where('id', $request->questionnaire_id)->get()->first();
        $questionnaireName = $questionnaire->name;

        if($request->input('action') == "previous"){
            if($request->questions == NULL){
                return redirect()->route('deceased.questionnaire', compact('questionnaireName'));
            }
        }

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

        if($request->input('action') == "next"){
            return redirect()->route('questionnaire.filledin', compact('questionnaireName'));
        }else{
            return redirect()->route('deceased.questionnaire', compact('questionnaireName'));
        }

        
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

        $questionnaireName = $questionnaire->name;

        if($request->input('action') == "next"){
            return redirect()->route('questionnaire.filledin', compact('questionnaireName'));
        }else{
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

        return redirect()->route('question.dashboard');
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
        $request->validate([
            'question' => 'required',
        ]);

        $question->question = $request->question;
        $question->save();

        return redirect()->route('question.dashboard');
    }

    /**
     * Delete a question.
     */
    public function questionDelete(question $question){
        $answers = Answer::where('question_id', $question->id)->get();
        foreach($answers as $answer){
            $answer->delete();
        }

        $question->questionnaires()->detach();

        $question->delete();

        return redirect()->route('question.dashboard');
    }
}
