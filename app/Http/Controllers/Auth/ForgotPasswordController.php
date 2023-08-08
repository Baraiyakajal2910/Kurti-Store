<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('layouts.front.auth.password.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'required|min:12|max:255',
         ]);
        
        $user=User::where('email',$request->email)->first();
            
            if(isset($user->email)) {  

                 $token = hash('sha256',Str::random(60));

                User::where('email',$request->email)->update(['forgotpwd_token'=>$token]);

                $data = ['title'=>'Hello Welcome to Abani','content'=>$token];

                Mail::send('layouts.front.auth.password.reset_email',$data,function($message)use($request){
                    $message->to($request->email)->subject('Reset password');
                });
                if(isset($data))
                {
                    session::flash('success','Password Reset Link sent.');
                }
                else
                {
                    session::flash('danger','There is some Problem to send Email please check Email Id');
                }
                return redirect ('/reset');
            }
    }


}
