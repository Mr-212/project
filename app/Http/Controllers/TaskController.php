<?php namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\Sprints;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachments;


class TaskController extends Controller{
    
    public function getIndex(){
        $tasks=Tasks::get();
        //dd($tasks[1]->attachments);
        return view('task.index')->with([
           'tasks'  => $tasks,
        ]);
    }

    public function getAttachmens($id){
        $attach=Attachments::whereTaskId($id)->get();
        //dd($Tasks);
        return view('task.index')->with([
            'attachments'  => $attach,
        ]);
    }

    public function getAjax(){
        $id=Input::get('id');
//        if($id==0){
//            return response()->json([0=>['id'=>'0','name' =>'Select Sprint']]);
//        }

        $sprints=Sprints::whereProjectId($id)->get()->lists('name','id')->toArray();
        return response()->json(['0' =>'Select Sprint']+$sprints);
    }
    public function getAdd(){
          $projects=Projects::get()->lists('name','id')->toArray();
          $projects=['0'=>'Select Project']+$projects;
          $users=User::get()->lists('name','id')->toArray();
        //dd($users);
        return view('task.add')->with([
            'head'     =>'Add Task',
            'link'     =>'/task/add/',
            'projects'    =>$projects,
            'users' =>$users,
        ]);
    }

    
    public function postAdd($id=null){

        try {
            \DB::beginTransaction();
             $task=!empty($id)? Tasks::find($id): new Tasks();
             //dd(Input::all());

            //$task = new Tasks();
            //$task->company_id=\Auth::user()->company->id;

            $task->name = Input::get('name');
            $task->description = Input::get('description');
            $task->sprint_id = Input::get('sprint_id');
            $task->user_id = Input::get('user_id');
            $task->save();
            //dd($task->name);
            //$files = Input::file('file');
            $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

            if (Input::hasFile('file')) {
                try {

                    $files = Input::file('file');
                    Attachments::addFile($files, $task->id);


                } catch (\Exception $e) {
                    \DB::rollback();
                    flash()->error('An Excecption occured ' . $e->getMessage());
                    return redirect('/task/add');
                }
            }
            \DB::commit();


        }catch (\Exception $e){
            \DB::rollback();
            flash()->error('An Excecption occured '.$e->getMessage());
            return redirect('/task/add');
        }


            empty($id)? flash()->success(Input::get('name') . " has been added successfully")
            : flash()->success(Input::get('name') . " has been updated successfully");
            return redirect('/task');

    }
    public function getEdit($id){
        $projects=Projects::get()->lists('name','id')->toArray();
        //dd($projects);
        $projects=['0'=>'Select Project']+$projects;
        $task=Tasks::find($id);
        $users=User::get()->lists('name','id')->toArray();
        //dd($user->name);
     
        return view('task.add')->with([
            'task'  =>$task,
            'head'     =>'Edit '.$task->name,
            'link'     =>'/task/add/'.$id,
            'type'     =>'edit',
            'users'    =>$users,
            'projects' =>$projects,
        ]);
    }
    
    public function postEdit($id){
        $task=Tasks::find($id);
        //dd($user->name);
        //$user->company_id=\Auth::user()->company->id;
        
        $task->name=Input::get('name');
        $task->description=Input::get('description');
        $task->sprint_id=Input::get('sprint_id');
        $task->save();
        flash()->success(Input::get('name')." has been updated successfully");
        return redirect('/task');
    }
    
    public function getDelete($id){
        
         try{
             
            $task=  Tasks::find($id);
            return view('shared.dialog.confirm', [
               'type'    =>'danger',
               'title'   =>'Delete record ',
               'message' =>"Are you sure you want to delete  {$task->name}",
               'button'  =>'OK',
               'action'  =>"/task/delete/{$id}",
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
            $task=  Tasks::find($id);
            $name=$task->name;
            $task->delete();
            flash()->success($name.' has been deleted successfully');
            return redirect('/task');
        } catch (Exception $ex) {
          flash()->error("There is an error processing your request \n {$ex->getMessage()}");
          return rediret ('/task');
        }
    }
    
   
    
    

}
