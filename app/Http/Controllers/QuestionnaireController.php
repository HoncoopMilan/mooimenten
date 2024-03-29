<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Deceased;
use App\Models\Photo;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        }else{
            return redirect('/');
        }
    }

    /**
     * Everything is filled in.
     */
    public function filledin($questionnaireName)
    {
        $questionnaire = Questionnaire::where('name', $questionnaireName)->get()->first();

        $url = "questionnaire/" . $questionnaire->name;

        $data = QrCode::size(200)
        ->format('png')
        ->generate(url($url));

        $qrcode = base64_encode($data);

        if(Auth::user()->admin == 1 || (Auth::user()->company_id == $questionnaire->company_id && Auth::user()->company_id != null)){
            return view('questionnaire.filledin', compact('questionnaire', 'qrcode'));
        }else{
            return view('404');
        }
    }

    /**
     * Deceased step from the form.
     */
    public function deceased()
    {
        //
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
        $expireDefault = '2024-01-24';

        if(Auth::user()->company_id != null){
            Questionnaire::create([
                'name' => $request->name,
                'deceased_id' => null,
                'expire' => $expireDefault,
                'customer_code' => $faker->regexify('[A-Z]{5}[0-4]{3}'),
                'company_id' => Auth::user()->company_id
            ]);
        }else{
            Questionnaire::create([
                'name' => $request->name,
                'deceased_id' => null,
                'expire' => $expireDefault,
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

        //Checkt of de vragenlijst al verlopen is & Alles nodige informatie is ingevuld
        if(!$questionnaire || !$questionnaire->deceased || !$questionnaire->questions)
        {
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
        $user = Auth::user();
        $questionnaire = Questionnaire::find($id);

        if($questionnaire->company_id == $user->company_id || $user->admin == 1){

            $questionnaire->deceased_id = null;
            $questionnaire->company_id = null;
            $questionnaire->save();

            $deceased = $questionnaire->deceased;
            if ($deceased != null) {
                Storage::delete('public/' . $deceased->img);
                $deceased->delete();
            }

            $questionnaire->questions()->detach();

            $photos = Photo::where('questionnaire_id', $questionnaire->id)->get();
            if($photos != null){
                foreach($photos as $photo){
                Storage::delete('public/' . $photo->img);
                $photo->delete();     
                }
            }

            $answers = Answer::where('questionnaire_id', $questionnaire->id)->get();
            if(   $answers !=null){
                foreach($answers as $answer){
                    $answer->delete();
                }
            }

            $questionnaire->delete();
            
            return redirect()->route('questionnaire.index');
        }else{
            return view('404'); 
        }
    }
}
