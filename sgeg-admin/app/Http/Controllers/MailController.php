<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Mail\NotificationMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Role;
use App\Models\Degree;
use App\Models\Attachment;

class MailController extends Controller
{
     public function index() {
         
        $roles = Role::all();
        $degrees = Degree::all();
        $selected = "";
        $invitations = Attachment::all()->where('type','doc');
        return view('emails.index', compact('degrees', 'roles', 'selected', 'invitations'));
     }


    public function multiSend(Request $request): View
    {
       
        $recipients = User::whereIn('id', explode(',', $request->get('selected')))->get();
        $selected ="";
        foreach ($recipients as $recipient) {
            $selected .= $recipient->name." <".$recipient->email.">, ";
        }
        
        $roles = Role::all();
        $degrees = Degree::all();
        $invitations = Attachment::all()->where('type','doc');

        return view('emails.index', compact('recipients','degrees', 'roles', 'invitations', 'selected'));
    }
    
    public function multiSendMail(Request $request): RedirectResponse
    {
      
        
        $content = array();
        $content['subject'] = $request->subject;
        $content['attachment'] = $request->invitation;
        $content['text'] = $request->description;
        
        if (!empty($request->recipients)) {
            $recipients = json_decode($request->recipients);
            
            foreach ($recipients as $recipient) {
                Mail::to($recipient->email)
                    ->send(new InvitationMail($recipient->name, $content))
                    ->attach('pathfile');
            }
        }
        if (!is_null($request->roles)) {
            $filter = $request->roles;

            if (!is_null($request->degree)) {
                $users = $users = User::role($filter)->get();
            } else {
                $users = $users = User::role($filter)->wherein('degree_id', $request->degree)->get();
            }
            if(!empty($users)) {
                foreach ($users as $recipient) {
                    Mail::to($recipient->email)
                        ->send(new InvitationMail($recipient->name, $content))
                        ->attach('pathfile');
                }
            }
        }

        return redirect()->route('email.send-multiple', compact('recipients'));

        
    
    }
     public function sendMail(): View {
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

     public function previewNotification() {
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
      
  }
  
