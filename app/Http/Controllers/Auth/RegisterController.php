<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        if(Auth::check() && Auth::user()->isAdmin ==1){
            $this->redirectTo = RouteServiceProvider::ADMINHOME;
        }else{
            $this->redirectTo = RouteServiceProvider::STUDENTHOME;
        }


        $this->middleware('guest');
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
            'first_name' => ['required', 'string', 'max:255'],
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
//        dd($data['first_name']);

//      $user =  User::create([
//            'first_name' => $data['first_name'],
//            'last_name' => $data['last_name'],
//            'email' => $data['email'],
//            'isAdmin'=>2,
//            'password' => Hash::make($data['password']),
//        ]);

       $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->isAdmin = 2;
        $user->password =  Hash::make($data['password']);
        $user->save();

        $student = new Student();
        $student->first_name = $data['first_name'];
        $student->last_name = $data['last_name'];
        $student->student_id = $data['student_id'];
        $student->email = $data['email'];
        $student->user_id = $user->id;
        $student->save();
        return $user;
    }
}
