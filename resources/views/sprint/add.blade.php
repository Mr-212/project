@extends('layout',['active'=>'sprint'])
@section('css')
    <style type="text/css">
        #discription,#members{
            height: 100px;
        }
    </style>
@stop
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
                        <label for=''>Sprint Name</label>
                        {!! Form::text('name',!empty($sprint->name)?$sprint->name:null,['class'=>'form-control','required'=>'','placeholder'=>'Sprint Name']) !!}
                    </div>
                      <div class="form-group">
                            <label for=''>Description </label>
                            {!! Form::textarea('description',!empty($sprint->description)?$sprint->description:'',['id'=>'discription','class' => 'form-control', 'required'=>'','placeholder'=>'Description' ]) !!}
                        </div>

                    <div class="form-group">
                        <label for=''>Select Project</label>
                        {!! Form::select('project_id', $projects, !empty($sprint->project_id)?$sprint->project_id:'',['id'=>'user','class' => 'form-control', 'required'=>'' ]) !!}
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
