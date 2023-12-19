<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('companies.index', compact('companies'));
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
        if(Company::where('name', $request->name)->exists()){
            return redirect()->back()->with('error', 'De naam bestaat al');   
        }

        $request->validate([
            'name' => 'required'
        ]);

        Company::create([
            'name' => $request->name
        ]);

        return redirect()->route('companies.index')->with('succes', 'het bedrijf is succesvol aangemaakt');   
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
    public function edit(string $companyName)
    {
        $company = Company::where('name', $companyName)->first();
        if($company != null){
            $users = User::whereNull('company_id')->get();
            return view('companies.edit', compact('company', 'users'));
        }else{
            return view('404');   
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //Zorgt ervoor dat een user aan een company word gelinkt
        if($request->users != null){
            foreach($request->users as $user_id){
                $user = User::where('id', $user_id)->first();
                $user->company_id = $request->company_id;
                $user->save();
            }
        }

        if($request->delete_users != null){
            foreach($request->delete_users as $user_id){
                $user = User::where('id', $user_id)->first();
                $user->company_id = null;
                $user->save();
            }
        }

        $company = Company::where('id', $request->company_id)->first();
        $companyName = $company->name;
        return redirect()->route('companie.edit', compact('companyName'));   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::where('id', $id)->first();
        $users = User::where('company_id', $company->id)->get();

        if($users != null){
            foreach($users as $user){
                $user->company_id = null;
                $user->save();
            }
        }

        $company->delete();

        return redirect()->route('companies.index');
    }
}
