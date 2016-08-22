<?php namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Projects;



class ProjectController extends Controller{
    
    public function getIndex(){
        $projects=Projects::get();
        return view('projects.index')->with([
           'projects'  => $projects,
        ]);
    }

//    public function getSprint($id){
//        $projects=Projects::find($id);
//        return view('projects.index')->with([
//            'projects'  => $projects,
//        ]);
//    }
    
    public function getAdd(){

        $users=User::get()->lists('name','id')->toArray();
        //dd($users);
        $users=['0'=>'Select a User']+$users;

        //dd($users);
        return view('projects.add')->with([
            'head'     =>'Add Project',
            'link'     =>'/project/add/',
            'users'    =>$users,
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
        $project=new Projects();
        //$project->company_id=\Auth::user()->company->id;
        
        $project->name=Input::get('name');
        $project->description=Input::get('description');
        $project->members=Input::get('members');

        
        $project->save();
        flash()->success( Input::get('name')." has been added successfully");
        return redirect('/project');
    }
    public function getEdit($id){

        $users=User::get()->lists('name','id')->toArray();
        //dd($users);
        $users=['0'=>'Select a User']+$users;
        $project=Projects::find($id);
        //dd($user->name);
     
        return view('projects.add')->with([
            'project'  =>$project,
            'head'     =>'Edit '.$project->name,
            'link'     =>'/project/edit/'.$id,
            'type'     =>'edit',
            'users'   =>$users,
        ]);
    }
    
    public function postEdit($id){
        $project=Projects::find($id);
        //dd($user->name);
        //$user->company_id=\Auth::user()->company->id;
        
        $project->name=Input::get('name');
        $project->description=Input::get('description');
        $project->members=Input::get('members');
        $project->save();
        flash()->success(Input::get('name')." has been updated successfully");
        return redirect('/project');
    }
    
    public function getDelete($id){
        
         try{
             
            $project=  Projects::find($id);
            return view('shared.dialog.confirm', [
               'type'    =>'danger',
               'title'   =>'Delete record ',
               'message' =>"Are you sure you want to delete this {$project->name}",
               'button'  =>'OK',
               'action'  =>"/project/delete/{$id}",
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
            $project=  Projects::find($id);
            $project->delete();
            flash()->success('Project has been deleted successfully');
            return redirect('/project');
        } catch (Exception $ex) {
          flash()->error("There is an error processing your request \n {$ex->getMessage()}");
          return rediret ('/project');
        }
    }
    
   
    
    

}
