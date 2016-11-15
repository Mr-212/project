<?php namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Projects;
use App\Models\Members;



class ProjectController extends Controller{

    public function __construct(){
        $this->middleware('admin',['except'=>['getIndex','getProfile']]);
    }
    
    public function getIndex(){
        if(\Auth::user()->type=='User')
            $projects=Projects::Userprojects(\Auth::user()->id);
        //dd($projects);
        else
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

        //$users=User::get()->lists('name','id')->toArray();
        $users=User::select('id','name','email')->get();
        //dd($users);
        //$users=['0'=>'Select a User']+$users;

        //dd($users);
        return view('projects.add')->with([
            'head'     =>'Add Project',
            'link'     =>'/project/add/',
            'users'    =>$users,
        ]);
    }

    
    public function postAdd(\App\Http\Requests\ProjectRequest $request){
        try {
            \DB::beginTransaction();
            $project = new Projects();
            //$project->company_id=\Auth::user()->company->id;

            $project->name = Input::get('name');
            $project->description = Input::get('description');
            $project->members = Input::get('members');
            $project->user_ids = (Input::get('ids'));
            $project->save();

            $ids=Input::get('ids');
            $ids=json_decode($ids,1);
            //list($ids)=array_column($ids,'user_id');
            //dd($ids);
            foreach($ids as $k=>$v){
                $member=new Members();
                $member->user_id=$v['user_id'];
                $member->project_id=$project->id;
                $member->save();
                //dd($v['user_id']);
            }

            \DB::commit();
            flash()->success(Input::get('name') . " has been added successfully");
            return redirect('/project');
        }catch (\Exception $e){
            \DB::rollback();
            flash()->error($e->getMessage());
            return redirect('/project/add');
        }
    }

    public function getEdit($id){

        //$users=User::get()->lists('name','id')->toArray();
        $users=User::select('id','name','email')->get();
        //dd($users);
        //$users=['0'=>'Select a User']+$users;
        $project=Projects::find($id);
        //dd($project->members);
     
        return view('projects.add')->with([
            'project'  =>$project,
            'head'     =>'Edit '.$project->name,
            'link'     =>'/project/edit/'.$id,
            'type'     =>'edit',
            'users'   =>$users,
        ]);
    }
    
    public function postEdit(\App\Http\Requests\ProjectRequest $request,$id){


        try {
            \DB::beginTransaction();
            $project=Projects::find($id);
            //dd(Input::all());
            //dd($project);
            //$project->company_id=\Auth::user()->company->id;

            $project->name = Input::get('name');
            $project->description = Input::get('description');
            $project->members = Input::get('members');
            $project->user_ids = Input::get('ids');
            $project->save();

            $ids=Input::get('ids');
            $ids=json_decode($ids,1);

            $delete=\DB::table('members')->whereProjectId($id)->delete();


            foreach($ids as $k=>$v){
                $member=new Members();
                //$member=new Members();
                $member->user_id=$v['user_id'];
                $member->project_id=$project->id;
                $member->save();
                //dd($v['user_id']);
            }


            \DB::commit();
            flash()->success(Input::get('name') . " has been updated successfully");
            return redirect('/project');
        }catch (\Exception $e){
            \DB::rollback();
            flash()->error($e->getMessage());
            return redirect('/project/edit/'.$id);
        }


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
