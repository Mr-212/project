@extends('layout', ['active'=>'project'])
@section('content')
<div class="row">
    <div class="col-lg-12 ">
        <h1 class="page-header">Projects

            @if(\Auth::user()->type=='Admin')
            <a class="btn btnpd0 btn-labeled btn-success  pull-right" href='/project/add'>
                <span class="btn-label">
                    <i class="fa fa-plus-circle"></i>
                </span>
                Add Project
            </a>
            @endif
           </h1>         
    </div>
</div>
     
    <div class="row">
        <div class="col-lg-12"  >
          

            <div class="table-responsive" >
                <table class="table table-striped table-bordered table-hover" id='dataTables'>
                    <thead>
                        <tr>
                            @if(\Auth::user()->type=='Admin')
                            <th width="70"></th>
                            @endif
                            <th>Name</th>
                            <th>Description</th>
                            <th>Members</th>
                            <th>Sprints</th>
                                        
                        </tr>
                       
                    </thead>
                    <tbody>

                        @foreach ($projects as $project)
                        <tr>
                            @if(\Auth::user()->type=='Admin')
                            <td>

                                <a class="btn btn-primary btn-xs" href="/project/edit/{{$project->id}}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href='project/delete/{{$project->id}}' data-toggle='modal' data-target='#modal'><i class="fa fa-times"></i></a>

                            </td>
                            @endif
                           
                           
                            <td>{{$project->name }}</td>
                            <td>{{$project->description}}</td>
                            <td>{{$project->members}}</td>
                            <td><a class="btn btn-info" href='sprint/sprint/{{$project->id}}'> <i class="fa fa-folder-o"></i> Sprints</a></td>
                        </tr>
                        @endforeach   
                    </tbody>      
                </table>
            </div>
        </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Please wait loading...</h4>
        </div>
        <div class="modal-body">
          Loading...
        </div>
      </div>
    </div>
  </div>

@stop

@section('js')
<script>
 $(document).ready(function(){
     $('#dataTables').dataTable({
         'paging'  :true,
         'ordering':true
     });
     $('#modal').on('hidden.bs.modal',function(){
        $(this).removeData('bs.modal') ;  
     });
     
 });
</script>
@stop

