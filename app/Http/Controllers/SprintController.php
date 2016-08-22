<?php namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Projects;
use App\Models\Sprints;



class SprintController extends Controller{
    
    public function getIndex(){
        $sprint=Sprints::get();
        return view('sprint.index')->with([
           'sprints'  => $sprint,
        ]);
    }

    public function getSprint($id){
        $sprints=Sprints::whereProjectId($id)->get();
        //dd($sprints);
        return view('sprint.index')->with([
            'sprints'  => $sprints,
        ]);
    }

    public function getTasks($id){
        $tasks=Sprints::find($id)->tasks;
        //dd($tasks[0]->name);
        return view('task.index')->with([
            'tasks'  => $tasks,
        ]);
    }
    public function getAdd(){

          $projects=Projects::get()->lists('name','id')->toArray();
//        //dd($users);
          $projects=['0'=>'Select Project']+$projects;

        //dd($users);
        return view('sprint.add')->with([
            'head'     =>'Add Sprint',
            'link'     =>'/sprint/add/',
            'projects'    =>$projects,
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
    
    public function postAdd(){
        $sprint=new Sprints();
        //$sprint->company_id=\Auth::user()->company->id;
        
        $sprint->name=Input::get('name');
        $sprint->description=Input::get('description');
        $sprint->project_id=Input::get('project_id');

        
        $sprint->save();
        flash()->success( Input::get('name')." has been added successfully");
        return redirect('/sprint');
    }
    public function getEdit($id){

        $projects=Projects::get()->lists('name','id')->toArray();
//        //dd($users);
        $projects=['0'=>'Select Project']+$projects;
        $sprint=Sprints::find($id);
        //dd($user->name);
     
        return view('sprint.add')->with([
            'sprint'  =>$sprint,
            'head'     =>'Edit '.$sprint->name,
            'link'     =>'/sprint/edit/'.$id,
            'type'     =>'edit',
            'projects'   =>$projects,
        ]);
    }
    
    public function postEdit($id){
        $sprint=Sprints::find($id);
        //dd($user->name);
        //$user->company_id=\Auth::user()->company->id;
        
        $sprint->name=Input::get('name');
        $sprint->description=Input::get('description');
        $sprint->project_id=Input::get('project_id');
        $sprint->save();
        flash()->success(Input::get('name')." has been updated successfully");
        return redirect('/sprint');
    }
    
    public function getDelete($id){
        
         try{
             
            $sprint=  Sprints::find($id);
            return view('shared.dialog.confirm', [
               'type'    =>'danger',
               'title'   =>'Delete record ',
               'message' =>"Are you sure you want to delete  {$sprint->name}",
               'button'  =>'OK',
               'action'  =>"/sprint/delete/{$id}",
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

        try{        
            $sprint=  Sprints::find($id);
            $sprint->delete();
            flash()->success('Sprint has been deleted successfully');
            return redirect('/sprint');
        } catch (Exception $ex) {
          flash()->error("There is an error processing your request \n {$ex->getMessage()}");
          return rediret ('/sprint');
        }
    }
    
   
    
    

}
