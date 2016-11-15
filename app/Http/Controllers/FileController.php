<?php namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Province;
use Illuminate\Support\Facades\Input;
use App\Models\Attachments;
use Symfony\Component\HttpFoundation\Session\Storage;
use Symfony\Component\HttpFoundation\File\File;



class FileController extends Controller{

    public function __construct(){
        $this->middleware('admin',['only'=>['getDelete']]);
    }
    public function getFind($id){
        $attach=Attachments::whereTaskId($id)->get();
        //dd($attach);
        return view('attachments.file')->with([
            'files'  =>$attach,
        ]);

    }
    public function getView($id){
        $attach=Attachments::find($id);
        //dd($attach);
        //$file=\Storage::disk('local')->get($attach->name);
        $file=public_path().'/uploads/'.$attach->name;
        //$file=storage_path().'/app/uploads/'.$attach->name;
        $header=[
            'Content-Type'=>$attach->mime,
        ];
        return response()->file($file,$header);
    }


    public function getDownload($id){
        $attach=Attachments::find($id);
        $file=public_path().'/uploads/'.$attach->name;
        $header=[
            'Content-Type'=>$attach->mime,
        ];
        return response()->download($file);
    }
    public function getDelete($id){
        $attach=Attachments::find($id);
        if(\Storage::has($attach->name)) {
            $file = \Storage::delete($attach->name);
        }
        $attach->delete();
        flash()->success('Item deleted successfully');
        return redirect()->back();
    }





}
