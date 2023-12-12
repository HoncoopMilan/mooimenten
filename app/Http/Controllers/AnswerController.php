<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Photo;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        if($request->img == null){
            return redirect()->back()->with('imgError', 'Je moet 1 of meerdere afbeeldingen geselecteerd hebben');   
        }

        foreach($request->questions as $question_id => $answer){
            if($answer == null){
                return redirect()->back()->with('questionError', 'Je hebt niet alle vragen ingevuld');   
            }

            Answer::create([
                'answer' => $answer,
                'questionnaire_id' => $request->questionnaire_id,
                'question_id' => $question_id,
            ]);
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
    public function show(string $id)
    {
        //
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
