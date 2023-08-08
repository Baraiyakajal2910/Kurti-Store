<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use App\User;
use Redirect;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('layouts.front.auth.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request){

        $validatedData = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);

       // $request->validate($this->rules(),$this->validationErrorMessages());
        $user=User::where('forgotpwd_token',$request->token)->first();
            if (isset($user->forgotpwd_token)) 
            {
                    User::where('email',$user->email)->update(['password'=>Hash::make($request->password)]);
                    return redirect::to('login');
            }
        
    }
}

?>