<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('layouts.front.auth.register');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function checkEmail(Request $request)
    {
        // return response()->json(['msg'=>$request->access_url]);
        $email =User::where('id','!=',$request->id)->where('email',$request->email)->first();
        if(isset($email))
        {   
            // return response()->json(['msg'=>$email]);
            return json_encode(false);
        }
        else
        {
            return json_encode(true);
        }
    }
    protected function store(Request $request)
    {
        // return $request;

        $validatedData = $request->validate([
            'name'=>'required',
            'gender'=>'required',
            'email'=>'required|unique:users|min:12|max:255',
            'password' => 'required|min:6|max:30',
            'phone_no' => 'required|unique:users|max:10',
         ]);
        $userCount = User::Where('email',$request->email)->count();
        // return $userCount;
        if($userCount > 0){
            Session::flash('danger','This Email Id is Already Registered Please Enter Unique Email Id ');
            return redirect('/register');
         }
        else{
            // return"bhj";
                User::create(['name'=>$request->name,'gender'=>$request->gender,'email'=>$request->email,
                    'password'=>$request->password,'phone_no'=>$request->phone_no]);
            return redirect('login');   
        }
    }

    
}