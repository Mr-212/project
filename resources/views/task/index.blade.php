@extends('layout', ['active'=>'task'])
@section('content')

    <style>
        .red{
            background-color: red;
        }
        .green{
            background-color: green;
        }
        .orange{
            background-color: orange;
        }

    </style>
<div class="row">
    <div class="col-lg-12 ">
        <h1 class="page-header">Tasks

            @if(\Auth::user()->type=='Admin')
            <a class="btn btnpd0 btn-labeled btn-success  pull-right" href='/task/add'>
                <span class="btn-label">
                    <i class="fa fa-plus-circle"></i>
                </span>
                Add Task
            </a>
            @endif
           </h1>         
    </div>
</div>
     
    <div class="row"  >
        <div class="col-lg-12" >
          

            <div class="table-responsive" ng-app="chat" ng-controller="taskcontroller">
                <table class="table table-striped table-bordered table-hover"  id='dataTables' ng-table="tableParams" >
                       {{--datatable="ng" dt-options="showCase.dtOptions" dt-column-defs="showCase.dtColumnDefs">--}}
                    <thead>
                        <tr>
                            @if(\Auth::user()->type=='Admin')
                            <th width="100"></th>
                            @else
                            <th width="40"></th>
                            @endif
                            <th class="name">Name</th>
                            <th>Description</th>
                            <th>Employee</th>
                            <th>Sprint</th>
                            <th>Project</th>
                            <th width="80">Status</th>
                            <th width="200">Expiry</th>
                            <th width="100">Attachments</th>
                                        
                        </tr>
                       
                    </thead>
                    <tbody>


                        {{--@foreach (qtasks as qtask)--}}
                        <tr ng-repeat="task in tasks">

                            <td>
                                {{--<a class="btn btn-default btn-xs" href='task/view/@{{ task.id}}'><i class="fa fa-sticky-note"></i></a>--}}
                                <a class="btn btn-primary btn-xs edit" href="task/edit/@{{task.id}}"><i class="fa fa-pencil"></i></a>
                                @if(\Auth::user()->type=='Admin')
                                <a class="btn btn-danger btn-xs" href='task/delete/@{{task.id}}' data-toggle='modal' data-target='#modal'><i class="fa fa-times"></i></a>
                                @endif
                            </td>



                            <td ng-bind="task.name"></td>
                            <td ng-bind="task.description"></td>
                            <td ng-bind="task.user.name"></td>
                            <td ng-bind="task.sprint.name"></td>
                            <td ng-bind="task.sprint.project.name"></td>
                            <td class="status" ng-bind="task.taskstatus"></td>
                            <td class="expiry" value="@{{task.taskstatus}}" ng-bind="task.expiry"></td>
                            <td><a  href="/file/find/@{{task.id}}" data-toggle="modal" data-target="#modal" >View </a>

                            @if(\Auth::user()->type=='User')
                                    <a class="btn btn-primary closetask" style="display: none;"  href="/task/closetask/@{{task.id}}" value="@{{task.taskstatus}}">Close Task</a>
                            @endif
                            </td>
                        </tr>

                        {{--@endforeach   --}}
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
    //$q.noConflict();

 $(document).ready(function(){

//
//     $('#dataTables').dataTable({
//         'paging'  :true,
//         'ordering':true
//     });
//     $('#modal').on('hidden.bs.modal',function(){
//         $(this).removeData('bs.modal') ;
//     });

     //console.log($('.status').data())
//
//     $('table > tbody').find('.status').each(function(){
//         console.log($(this).text());
//         $(this).css('back-ground-color','red');
//     })
//]
////         q('.countdown').each(function () {
////             var qthis = q(this), finalDate = q(this).text();
////             console.log(finalDate);
////             qthis.countdown(finalDate, function (event) {
////                 qthis.html(event.strftime('%D days %H:%M:%S'));
////             });
////         });
//
//
////     q.getJSON('/task').done(function (json) {
////                     console.log(json);
////         q(json).each(function(k,v){
////             console.log(v.name);
////
////         })
////
////     }).fail(function(statusText){
////                     console.log(statusText);
////     });
//
//
//
//
 });
</script>
@stop

