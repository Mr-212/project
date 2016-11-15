<?php namespace App\Http\Controllers;
use App\Models\Members;
use App\Models\User;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\Sprints;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachments;
use Psy\Util\Json;
use Illuminate\Support\Facades\Mail;


class TaskController extends Controller{

    public function __construct(){
    $this->middleware('admin',['except'=>['getIndex','getClosetask','getEdit','postEdit']]);
   }
    
    public function getIndex(){
        if(\Request::ajax() || \Request::wantsJson()){
            if(\Auth::user()->type=='User')
                $tasks=Tasks::with('sprint.project','user')->whereUserId(\Auth::user()->id)->get();
            else {
                $tasks = Tasks::with('sprint.project', 'user')->get();
                foreach ($tasks as $task) {
                    if ($task->status == \App\Models\Type\TaskStatus::OPEN) {
                        if (strtotime($task->task_end) < strtotime('now')) {
                            $task = Tasks::find($task->id);
                            $task->status = \App\Models\Type\TaskStatus::EXPIRED;
                            //$task->task_end="Expired";
                            $task->save();
                            $text="The task you are assigned to has been expired. Thank you.";
                            \Mail::send('mail.task', ['task'=>$task,'text'=>$text], function ($m,$task) {
                                $m->from("noreply@keratintech.com");
                                $m->to(["aliraza@fibertechonline.com",$task->user->email])->subject('Notification');
                            });
                        }
                    }
                }
            }
            //dd($tasks);
            return response()->json($tasks)->header("Vary", "Accept");

        }else {
            $tasks = Tasks::get();
            //dd($tasks[1]->expiry);
            return view('task.index')->with([
                'tasks' => $tasks,
            ]);
        }
    }

    public function getAttachmens($id){
        $attach=Attachments::whereTaskId($id)->get();
        //dd($Tasks);
        return view('task.index')->with([
            'attachments'  => $attach,
        ]);
    }

    public function getStatusexpire($id){
        dd($id);
        $id=Inpit::get('id');
        dd($id);
        $task=Tasks::find($id);
        dd($task);

    }

    public function getAjax(){
        $id=Input::get('id');
//        if($id==0){
//            return response()->json([0=>['id'=>'0','name' =>'Select Sprint']]);
//        }

        $sprints=Sprints::whereProjectId($id)->get()->lists('name','id')->toArray();
        $members=Members::with('user')->whereProjectId($id)->get()->toArray();
        //dd($sprints);
        return response()->json([['0' =>'Select Sprint']+$sprints,$members]);
    }
    public function getAdd(){
          $projects=Projects::get()->lists('name','id')->toArray();
          $projects=['0'=>'Select Project']+$projects;
          //$users=User::get()->lists('name','id')->toArray();
          //$users=Projects::select('user_ids')->get()->toArray();

       // $m=array_collapse($users);
        //dd(array_column($users,'user_ids'));

//        foreach($users as $k=>$v){
//            //list($v,$k)=explode(' ',$v['user_ids']);
//            dd(unserialize($v['user_ids']));
//        }
//          dd($users);
        return view('task.add')->with([
            'head'     =>'Add Task',
            'link'     =>'/task/add/',
            'projects'    =>$projects,
            //'users' =>$users,
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
            $task->task_end=Input::get('task_end');
            $task->status=Input::get('status');
            $task->project_id=Input::get('project_id');
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
                    flash()->error('An Exception occurred ' . $e->getMessage());
                    return redirect('/task/add');
                }
            }


            \DB::commit();

            //$mail=$task->user->email;



            empty($id)? flash()->success(Input::get('name') . " has been added successfully")
                : flash()->success(Input::get('name') . " has been updated successfully");
            return redirect('/task');


        }catch (\Exception $e){
            \DB::rollback();
            flash()->error('An Exception occurred '.$e->getMessage());
            return redirect('/task/add');
        }




    }
    public function getEdit($id){

        $projects=Projects::get()->lists('name','id')->toArray();
        //dd($projects);
        $projects=['0'=>'Select Project']+$projects;
        $task=Tasks::find($id);

        $sprints = !empty($task->project->id)?Sprints::whereProjectId($task->project->id)->lists('name','id'):null;
       // dd($sprints);
        //$sprints=array_pluck($sprints,'name','id');

        //dd($sprints);
        $pid=$task->sprint->project->id;
        //$users=Members::whereProjectId($pid)->user->get();
        $users=Tasks::Projectmembers($id);
        $users=array_pluck($users,'name','id');
        $users=['0'=>'Select a Member']+$users;
        //$users=$task->project->id;
         //dd($users);
//        foreach($users as $k=>$v ){
//            dd($v->user->name);
//        }
        //dd($user->name);

        return view('task.add')->with([
            'task'  =>$task,
            'head'     =>'Edit '.$task->name,
            'link'     =>'/task/edit/'.$id,
            'type'     =>'edit',
            'users'    =>$users,
            'projects' =>$projects,
            'sprints'  =>$sprints?$sprints:null,
        ]);
    }
    
    public function postEdit(\App\Http\Requests\TaskRequest $request,$id){
        //dd(Input::all());
        try {
            \DB::beginTransaction();
            $task= Tasks::find($id);
            //dd(Input::all());

            //$task = new Tasks();
            //$task->company_id=\Auth::user()->company->id;

            $task->name = Input::get('name');
            $task->description = Input::get('description');
            if(\Auth::user()->type=='Admin') {
                $task->sprint_id = Input::get('sprint_id');
                $task->user_id = Input::get('user_id') ? Input::get('user_id') : null;
                //dd(new \DateTime());
                if (Input::get('status') == \App\Models\Type\TaskStatus::CLOSED && $task->closed_at == null) {
                    $task->closed_at = new \DateTime();
                    $text = "The task has been completed successfully. Thank you.";
                    \Mail::send('mail.task', ['task' => $task, 'text' => $text], function ($m, $task) {
                        $m->from($task->user->email);
                        $m->to(["aliraza@fibertechonline.com", $task->user->email])->subject('Notification');
                    });
                    //dd($task->task_end);
                } else {
                    //$task->task_end=Input::get('task_end');
                    //dd($task->task_end);
                }
                $task->task_end = Input::get('task_end');
                $task->status = Input::get('status');
                $task->project_id = Input::get('project_id');
            }
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
                    flash()->error('An Exception occurred ' . $e->getMessage());
                    return redirect('/task/edit/'.$id);
                }
            }
            \DB::commit();
             //dd($task->toArray());
//            $text="You have been assigned to a new task. Login for check expiration date. Thank you.";
//            \Mail::send('mail.task', ['task'=>$task,'text'=>$text], function ($m) {
//                $m->from('noreply@keratintech.com');
//                $m->to("aliraza@fibertechonline.com")->subject('Notification');
//
//            });

          flash()->success(Input::get('name') . " has been updated successfully");
            return redirect('/task');


        }catch (\Exception $e){
            \DB::rollback();
            flash()->error('An Exception occurred '.$e->getMessage());
            return redirect('/task/edit/'.$id);
        }
    }

    public function getClosetask($id){
        $task=Tasks::find($id);
        $task->status=\App\Models\Type\TaskStatus::CLOSED;
        $task->closed_at=new \DateTime();
        $task->save();
        flash()->success($task->name. " has been closed successfully");
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
