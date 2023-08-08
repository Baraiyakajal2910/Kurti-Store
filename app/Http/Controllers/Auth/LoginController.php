<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\cart;
use Illuminate\Support\Facades\Session;
use Redirect; 

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
            return view('layouts.front.auth.login');
    }

        public function showAdminLoginForm()
    {
            return view('layouts.admin.auth.login');
    }

    public function checkUsername(Request $request)
    {
        // dd($request);
        // return response()->json(['msg'=>$request]);
        $email =User::where('email',$request->email)->first();
        
        if(isset($email))
        {   
            // return response()->json(['msg'=>$email]);
            return json_encode(true);
        }
        else
        {
            return json_encode(false);
        }
    }

    public function login(Request $request)
    {
        

        // if ((Auth::attempt(['email'=>$request->email,'password'=>$request->password])))
        // {
        //     if(Auth::check())
        //     {
        //          return redirect::to('admin/index');
        //     }
        // }
        // else
        // {
        //         return redirect::to('index');

        // }

        $validatedData = $request->validate([
            'email'=>'required|min:12|max:255',
            'password' => 'required|min:6|max:20',
         ]);

        $userStatus = User::where('email',$request->email)->first();
        // return $userStatus->deleted_at;
        if($userStatus->deleted_at != 'Y')
        {
            session::flash('danger','User are Blocked !');
            return redirect('login');
        }
        else
        {
            if ((Auth::attempt(['email'=>$request->email,'password'=>$request->password])))
            {
                //return Auth::user()->role;
                if(Auth::user()->role == '0')
                {
                    //return Auth::user()->role;
                    $cart = Session::get('cart',[]);
                    if(isset($cart))
                    {
                        // return $cart;
                        foreach ($cart as $key => $cart) 
                        {
                            // return $cart;
                            $data = cart::where('user_id', Auth::user()->id)->where('product_id', $cart['id'])->first();
                            // dd($data);
                            if(isset($data)){
                                $data->update(['qty' => isset($cart['qty']->qty) ? $cart['qty']->qty : 1]);
                            }
                            else
                            {
                                $data = cart::create(['user_id' => Auth::user()->id,
                                                      'product_id' => $cart['id'],
                                                      'qty' => (isset($cart['qty']) ? $cart['qty'] : 1),
                                                  ]);
                                // return $data;
                                // return response()->json($request->session()->get('data'));
                            }
                        }   
                        $request->session()->forget('cart');
                    }
                    return redirect('/');
                }
                else
                {
                    return redirect('admin/index');
                }

                return $this->sendFailedLoginResponse($request);
            }
        }
        // elseif ((Auth::attempt(['email'=>$request->email,'password'=>$request->password])))
        // {
        //     return redirect::to('index');
        // }
        

    }

    public function logout(Request $request)
    {
        // return "hello";
        // return $request;
        // if (Auth::check()) {
        //     return "test";
        // }
        // $role_id = Auth::user()->role;
        // dd($role_id);
            // return Auth::user()->role;
        if (Auth::user()->role == '1') {

           Auth::logout();
           return redirect::to('admin/login');
            
        }
        else {
            Auth::logout();
            return redirect::to('/');
        }
            
    }
    
}
