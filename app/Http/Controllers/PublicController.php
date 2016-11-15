<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PublicController extends Controller{

    public function __construct(){
        $this->middleware('guest',['except'=>['getLogout']]);
    }
    public function getLogin(){
        return view('public.login');
    }
    
    public function postLogin(){
        
        $email=Input::get('email');
        $password=Input::get('password');
        try {
            $user=User::where('email','=',$email)->first();
            //dd($user);
        if(!empty($email) &&!empty($user) && Hash::check($password, $user->password)){
            $user=\Auth::login($user);
            flash()->success("Logged in successfully");
            if(\Auth::user()->type=='Admin')
                return redirect('/user/');
            else
                return redirect('/project/') ;
        }
        return view('/public.login');
            
        } catch (Exception $ex) {
            flash()->error("Invalid UserNAme or Password");
            return redirect('/public/login');
        }
//        flash()->error("Invalid UserNAme or Password");
//            return redirect('/public/login');
        
    }
    
    public function getLogout(){
        \Auth::logout();
        flash()->success('Logged out successfully');
        return redirect('/public/login');
    }

}
