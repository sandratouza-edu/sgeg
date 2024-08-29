<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
     public function index() {
         return view('emails.index');
     }

     public function sendMail() {
         //Mail::to(Auth::user()->email); // email al usuario autenticado
         // Mail::to(env('MAIL_TO_TEST'))->send(new InvitationMail(env('MAIL_NAME_TEST'))); 
         Mail::to(env('MAIL_TO_TEST'))->send(new InvitationMail(env('MAIL_NAME_TEST'))); 
         //Mail::to('sandratouza@gmail.com')->bcc('sandra.pereira@edu.xunta.gal')
         //     ->send(new ExampleMail('Sandra', 'mail de ejemplo'))->attach('pathfile');;

         return view('emails.sent');
     }

     public function previewMail() {
          return ( new InvitationMail(env('MAIL_NAME_TEST')))->render();
     }

     public function sendNotification() {
          //get from database
          $response =  Mail::to('sandratouza@gmail.com')->bcc('sandra.pereira@edu.xunta.gal')
              ->send(new NotificationMail('Sandra', 'mail de ejemplo'));
              //->attach('/files/attached.txt');
          // Mail::bcc()
          dump($response);
      }
      
      public function previewNotification() {
          return ( new NotificationMail('Maria', 'Asuntito'))->render();
      }
  }
  
