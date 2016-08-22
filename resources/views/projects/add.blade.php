@extends('layout',['active'=>'projects'])
@section('content')
           <div class="row col-md-offset-3">
                <div class="col-lg-6 ">
                    <h1 class="page-header">{{$head}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
{!! Form::open(['url'=> $link]) !!}
           <div class="panel-body col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <div class="form-group">
                        <label for=''>Project Name</label>
                        {!! Form::text('name',!empty($project->name)?$project->name:null,['class'=>'form-control','required'=>'','placeholder'=>'Name']) !!}
                    </div>
                      <div class="form-group">
                            <label for=''>Description </label>
                            {!! Form::text('description',!empty($project->description)?$project->description:'',['class' => 'form-control', 'required'=>'','placeholder'=>'Description' ]) !!}
                        </div>

                    <div class="form-group">
                        <label for=''>Members</label>
                        {!! Form::text('members',!empty($project->members)?$project->members:'',['id'=>'members','class' => 'form-control', 'required'=>'','placeholder'=>'Members' ]) !!}
                    </div>
                    <div class="form-group">
                        <label for=''>Select a User</label>
                        {!! Form::select('users', $users, '',['id'=>'user','class' => 'form-control', 'required'=>'' ]) !!}
                    </div>

                </div>
              </div>
      

            <div class="row ">
                <div class="col-xs-6 col-md-6">
                    <button type="submit" class="btn btn-primary pull-right">Update Info</button>
                </div>
            </div>
           </div>
    {!! Form::close() !!}
@stop

@section('js')
<script>
    $(document).ready(function (){
        //var member='';
        $('#user').on('change', function() {

            user=$('#user option:selected').text();
            console.log(user);

            member=$('#members').val();
            console.log(member);
            member=member + user+ ", " ;
            $('#members').val(member);


        });

    });




</script>
@stop