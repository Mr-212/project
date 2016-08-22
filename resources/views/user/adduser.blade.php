@extends('layout',['active'=>'adduser'])
@section('content')
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-primary">
                   <div class="panel-heading">{{$head }}</div>
                
            
{!! Form::open(['url'=> $link]) !!}
           <div class="panel-body">
            <div class="row">
                <div class="col-xs-12  ">
                     <div class="form-group">
                            <label for='name'>Name</label>
                            {!! Form::text('name',isset($type)? $user->name: null,['class'=>'form-control','required'=>'','placeholder'=>'Name']) !!}
                     </div>
                     <div class="form-group">
                            <label for=''>Email </label>
                            {!! Form::text('email',isset($type)? $user->email:'',['class' => 'form-control', 'required'=>'','placeholder'=>'Email' ]) !!}
                     </div>
                    
                     <div class="form-group">
                            <label for=''>Password</label>
                            {!! Form::password('password',['class' => 'form-control', 'required'=>'','placeholder'=>'Password' ]) !!}
                     </div>
                        
                    
                </div>
              </div>
     
            
                <div class="panel-footer">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="pull-right">
                            <button type="reset"  class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-primary">Save changes</button> 
                        </div>
                    </div>
                
                </div> 
            
        
               </div>
               </div>
            </div>
        </div>
            
        
    {!! Form::close() !!}
           
            
@stop