<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
   public function index() {
        return view('index');
   }

   public function sendMail() {
        //Mail::to(Auth::user()->email); // email al usuario autenticado
       // Mail::to(env('MAIL_TO_TEST'))->send(new InvitationMail(env('MAIL_NAME_TEST'))); 
       Mail::to(env('MAIL_TO_TEST'))->send(new InvitationMail(env('MAIL_NAME_TEST'))); 


        return view('emails.sent');
   }
}
