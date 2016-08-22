@extends('layout',['active'=>'setting'])
@section('content')
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$head}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
{!! Form::open(['url'=> '/setting/edit']) !!}
           <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for='company name'>Company Name</label>
                        {!! Form::text('name',!empty($company->name)?$company->name:null,['class'=>'form-control','required'=>'']) !!}
                    </div>
                      <div class="form-group">
                            <label for=''>Email </label>
                            {!! Form::text('email',!empty($company->email)?$company->email:'',['class' => 'form-control', 'required'=>'' ]) !!}
                        </div>
                        <div class="form-group">
                            <label for=''>Phone</label>
                            {!! Form::text('phone',!empty($company->phone)?$company->phone:'',['class' => 'form-control', 'required'=>'' ]) !!}
                        </div>
                        
                    
                </div>
              </div>

            </div>
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <label for='address1'>Address</label>
                    {!! Form::text('address',(!empty($company->address))?$company->address:null,['class' => 'form-control','required' => '']) !!}
                </div>
                <div class="form-group">
                    <label for='address2'>Address Line 2</label>
                    {!! Form::text('address2',(!empty($company->address2))?$company->address2:null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for='city'>City</label>
                    {!! Form::text('city',(!empty($company->city))?$company->city:null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for='province_id'>State</label>
                    {!! Form::select('state',$province ,!empty($company->state)?$company->state:null, ['class'=>'form-control', 'required'=>true] ) !!}
                </div>

                <div class="form-group">
                    <label for='postal_code'>Postal Code</label>
                    {!! Form::text('postal_code',(!empty($company->zip))?$company->zip:null,['class' => 'form-control','required' => '']) !!}
                </div> 
            </div>
      
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">Update Info</button>
                </div>
            </div>
        </div>
            
        
    {!! Form::close() !!}
           
            
@stop