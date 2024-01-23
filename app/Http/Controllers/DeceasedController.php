<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeceasedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($questionnaireName)
    {
        $questionnaire = Questionnaire::where('name', $questionnaireName)->get()->first();
        if(Auth::user()->admin == 1 || (Auth::user()->company_id == $questionnaire->company_id && Auth::user()->company_id != null)){
            if($questionnaire->deceased_id == null){
                //Deceased geeft aan of de informatie over de overledenen al een keer is ingevuld
                $deceased = null;
            }
            else{
                $deceased = Deceased::where('id',$questionnaire->deceased_id)->get()->first();
            };

            return view('questionnaire.deceased', compact('questionnaire', 'deceased'));
        }else{
            return view('404');
        }
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
    public function store(Request $request, string $questionnaireName1)
    {
        $request->validate([
            'name' => 'required|min:3',
            'zipcode' => 'required',
            'city' => 'required',
            'adress' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_death' => 'required|date',
            'expire' => 'required|date',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $faker = \Faker\Factory::create('nl_NL');

        $imgName = $faker->numberBetween(10000, 200000) . $request->img->getClientOriginalName();

        $deceased = Deceased::create([
            'name' => $request->name,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'adress' => $request->adress,
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'img' => $imgName,
        ]);

        $request->file('img')
        ->storeAs('public', $imgName);

        //Linkt de informatie van de overledenen met de goede vragenlijst
        $questionnaire = Questionnaire::where('id', $request->questionnaire_id)->first();
        $questionnaire->expire = $request->expire;
        $questionnaire->deceased_id = $deceased->id;
        $questionnaire->save();

        $questionnaireName = $questionnaire->name;
        return redirect()->route('questions.questionnaire', compact('questionnaireName'));   
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
        $imgName = $request->img;

        $request->validate([
            'name' => 'required|min:3',
            'zipcode' => 'required',
            'city' => 'required',
            'adress' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_death' => 'required|date',
        ]);

        if($deceased->img == null){
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $faker = \Faker\Factory::create('nl_NL');
            $imgName = $faker->numberBetween(10000, 200000) . $request->img->getClientOriginalName();

            $request->file('img')
            ->storeAs('public', $imgName);
        }

        $deceased->fill([
            'name' => $request->name,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'adress' => $request->adress,
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'img' => $imgName
        ]);

        $deceased->save();

        $questionnaire = Questionnaire::where('id', $request->questionnaire_id)->get()->first();
        $questionnaireName = $questionnaire->name;

        return redirect()->route('questions.questionnaire', compact('questionnaireName'));   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(deceased $deceased)
    {
        //
    }

        /**
     * Remove the specified img from storage.
     */
    public function destroyImg($id){
        $deceased = Deceased::where('id', $id)->get()->first();

        $disk = Storage::disk('public');
        $disk->delete($deceased->img);

        $deceased->img = null;
        $deceased->save();

        $questionnaireName = Questionnaire::where('deceased_id', $deceased->id)->first()->name;

        return redirect()->route('deceased.questionnaire', compact('questionnaireName'));   
    }
}
