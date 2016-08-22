@extends('layout',['active'=>'task'])
@section('content')
           <div class="row col-md-offset-3">
                <div class="col-lg-6 ">
                    <h1 class="page-header">{{$head}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
{!! Form::open(['url'=> $link,'files'=>true]) !!}
           <div class="panel-body col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <div class="form-group">
                        <label for=''>Task Name</label>
                        {!! Form::text('name',!empty($task->name)?$task->name:null,['class'=>'form-control','required'=>'','placeholder'=>'Task Name']) !!}
                    </div>
                      <div class="form-group">
                            <label for=''>Description </label>
                            {!! Form::text('description',!empty($task->description)?$task->description:'',['class' => 'form-control', 'required'=>'','placeholder'=>'Description' ]) !!}
                        </div>
                    <div class="form-group">
                        <label for=''>Select Employee</label>
                        {!! Form::select('user_id', ['0'=>'Select Employee']+$users, !empty($task->user_id)?$task->user_id:'',['id'=>'','class' => 'form-control', 'required'=>'' ]) !!}
                    </div>

                    <div class="form-group">
                        <label for=''>Select Project</label>
                        {!! Form::select('project_id', $projects, !empty($task->project_id)?$task->project_id:'',['id'=>'project','class' => 'form-control', 'required'=>'' ]) !!}
                    </div>
                    <div class="form-group">
                        <label for=''>Select Sprint</label>
                        {!! Form::select('sprint_id',['0'=>'Select Sprint'] , !empty($task->sprint_id)?$task->sprint_id:'',['id'=>'sprint','class' => 'form-control', 'required'=>'' ]) !!}

                    </div>

                    <div class="form-group">
                        <label for=''>Task Expire</label>
                        {!! Form::date('task_end', !empty($task->task_end)?$task->task_end:date('Y-m-d',strtotime('now')),['id'=>'sprint','class' => 'form-control', 'required'=>'' ]) !!}
                    </div>

                    <div class="form-group">
                    <label>Choose File:
                        <span class="btn btn-default btn-file"><i class="fa fa-folder-open"></i>
                            Browse<input type="file" name="file[]" style="display: none;" multiple>
                        </span>
                    </label>
                    </div>


                </div>
              </div>
      
            <div class="col-xs-6 col-md-6">

                <div class="">
                    <button type="submit" class="btn btn-primary pull-right">Update Info</button>
                </div>
            </div>
           </div>
    {!! Form::close() !!}
@stop

@section('js')
<script>
    $(document).ready(function (){

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('input[name="_token"]').val(),
            },
        });


        $('#project').on('change', function() {

           data= {'id': $('#project').val()}
            //console.log(data);
            $.ajax({
                type:'GET',
                url:'/task/ajax',
                data:data,
                dataType:'json',
                success:function(data){
                    $('#sprint').empty();
                    //console.log(data);
                    $.each(data,function(id, name){
                        //console.log(id);
                        var option=$("<option>");
                        option.text(name).val(id);
                        $('#sprint').append(option);
                        //$('#sprint option').text(data.id).change();
                    });
                },
                error:function(){
                    console.log('data not found');
                }

            });


        });

    });

</script>
@stop