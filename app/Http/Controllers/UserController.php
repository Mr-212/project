<?php namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller{

    public function __construct(){
        $this->middleware('admin',['except'=>['getProfile','postEdit']]);
    }
    
    public function getIndex(){
        $user=User::whereCompanyId(\Auth::user()->company_id)->get();
        return view('user.index')->with([
           'user'  => $user,
            
        ]);
    }
    
    public function getAdd(){
        
        return view('user.adduser')->with([       
            'head'     =>'Add User', 
            'link'     =>'/user/add/',
        ]);
    }
    public function getProfile(){
        $user=User::find(\Auth::user()->id);
        //dd($user);
        return view('/user.adduser')->with([
            'head'   => "Edit Profile",
            'user'   =>$user,
            'link'   =>'/user/edit/'.\Auth::user()->id,
            'type'   =>'edit',
        ]);
    }
    
    public function postAdd(\App\Http\Requests\UserRequest $request){
        $user=new User();
        $user->company_id=\Auth::user()->company->id;
        
        $user->name=Input::get('name');
        $user->email=Input::get('email');
        $user->password=Hash::make(Input::get('password'));
        
        $user->save();
        flash()->success("User has been added successfully.");
        return redirect('/user');
    }
    public function getEdit($id){
        $user=User::find($id);
        //dd($user->name);
     
        return view('user.adduser')->with([
            'user'     =>$user,
            'head'     =>'Edit User',
            'link'     =>'/user/edit/'.$id,
            'type'     =>'edit',
        ]);
    }
    
    public function postEdit(\App\Http\Requests\UserRequest $request,$id){
        if(\Auth::user()->type=='User'){
            $id=\Auth::user()->id;
        }
        $user=User::find($id);
        //dd($user->name);
        $user->company_id=\Auth::user()->company->id;
        
        $user->name=Input::get('name');
        $user->email=Input::get('email');
        if(!empty(Input::get('password'))){
        $user->password=Hash::make(Input::get('password'));
        }
        $user->save();
        flash()->success("User has been updated successfully.");
        return \Auth::user()->type=='User'? redirect('/user/profile'):redirect('/user');
    }
    
    public function getDelete($id){
        
         try{
             
            $user=  User::find($id);
            return view('shared.dialog.confirm', [
               'type'    =>'danger',
               'title'   =>'Delete record ',
               'message' =>"Are you sure you want to delete this {$user->name}",
               'button'  =>'OK',
               'action'  =>"/user/delete/{$id}",              
            ]);
            
        } catch (Exception $ex) {
            return View::make('shared.dialog.message', [
                'type' => 'danger',
                'title' => 'Error Processing Your Request',
                'message' => "{$ex->getMessage()}",
                'button' => "OK",
            ]);
        }
    }
    public  function postDelete($id){
       // $fid=FormRecord::find($id);
        try{        
            $user=  User::find($id);
            $user->delete();
            flash()->success('Record has been deleted successfully.');
            return redirect('/user');
        } catch (Exception $ex) {
          flash()->error("There is an error processing your request \n {$ex->getMessage()}");
          return rediret ('/user');
        }
    }
    
   
    
    

}
