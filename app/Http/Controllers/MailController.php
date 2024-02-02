<?php

namespace App\Http\Controllers;

use App\Mail\SendCustomerCode;
use App\Models\Company;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MailController extends Controller
{
    public function sendMail(Request $request, Questionnaire $questionnaire)
    {
        $customerCode = $request->input('customerCode');
        $userEmail = $request->input('email');
        $expireDate = $questionnaire->expire;

        $expireDateTime = Carbon::parse($expireDate);

        $expireTime = $expireDateTime->format('H:i');
        $expireDateTime = $expireDateTime->format('d-m-Y');

        $company = $questionnaire->company;
        // Controleer of het bedrijf bestaat voordat je eigenschappen ophaalt
        $companyName = $company ? $company->name : 'Onbekend';
        // Stuur de mail
        Mail::to($userEmail)->send(new SendCustomerCode($customerCode, $expireDateTime, $expireTime, $companyName));

        // return "E-mail is verzonden naar $userEmail met klantcode $customerCode!";
        return redirect()->route('questionnaire.index')->with('succes', 'E-mail is verzonden naar ' . $userEmail . ' met klantcode ' .  $customerCode . '!');
    }
}
