@extends('layout', ['active'=>'task'])
@section('content')
<div class="row">
    <div class="col-lg-12 ">
        <h1 class="page-header">Tasks
                    
            
            <a class="btn btnpd0 btn-labeled btn-success  pull-right" href='/task/add'>
                <span class="btn-label">
                    <i class="fa fa-plus-circle"></i>
                </span>
                Add Task
            </a>
           </h1>         
    </div>
</div>
     
    <div class="row">
        <div class="col-lg-12"  >
          

            <div class="table-responsive" >
                <table class="table table-striped table-bordered table-hover" id='dataTables'>
                    <thead>
                        <tr>
                            <th width="65"></th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Employee</th>
                            <th>Sprint</th>
                            <th>Project</th>
                            <th>Attachments</th>
                                        
                        </tr>
                       
                    </thead>
                    <tbody>

                        @foreach ($tasks as $task)


                        <tr>
                            <td>

                                <a class="btn btn-primary btn-xs" href="task/edit/{{$task->id}}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href='task/delete/{{$task->id}}' data-toggle='modal' data-target='#modal'><i class="fa fa-times"></i></a>

                            </td>


                            <td>{{$task->name }}</td>
                            <td>{{$task->description}}</td>
                            <td>{{$task->user->name or null}}</td>
                            <td>{{$task->sprint->name}}</td>
                            <td>{{$task->sprint->project->name}}</td>
                            <td><a  href="/file/find/{{$task->id}}" data-toggle="modal" data-target="#modal" >View </a></td>
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

    <!--Image Modal-->


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

