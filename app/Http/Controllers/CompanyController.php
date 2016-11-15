<?php namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Province;
use Illuminate\Support\Facades\Input;


class CompanyController extends Controller{

    public function __construct(){
        $this->middleware('admin');
    }
    
    public function getIndex(){
        $comp=Company::find(\Auth::user()->company_id);
        //dd($comp->users);
        $province= Province::whereCountryId(176)->get()->lists('name','id');
        //dd($comp);
        return view('setting.edit')->with([
            'company'  =>$comp,
            'head'     =>'Company Setting', 
            'province' =>$province,
        ]);
    }

    public function postEdit(\App\Http\Requests\CompanyRequest $request){
        $comp=\Auth::user()->company;
        $comp->name=Input::get('name');
        $comp->phone=Input::get('phone');
        $comp->email=Input::get('email');
        $comp->address=Input::get('address');
        $comp->address2=Input::get('address2');
        $comp->state=Input::get('state');
        $comp->city=Input::get('city');
        $comp->zip=Input::get('postal_code');
        $comp->save();
        flash()->success("Setting has been updated successfully");
        return redirect('setting');
    }
    
    

}
