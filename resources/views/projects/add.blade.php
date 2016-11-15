@extends('layout',['active'=>'projects'])
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
                        <label for=''>Project Name</label>
                        {!! Form::text('name',!empty($project->name)?$project->name:null,['class'=>'form-control','required'=>'','placeholder'=>'Name']) !!}
                    </div>
                      <div class="form-group">
                            <label for=''>Description </label>
                            {!! Form::textarea('description',!empty($project->description)?$project->description:'',['id'=>'discription','class' => 'form-control', 'required'=>'','placeholder'=>'Description' ]) !!}
                        </div>


                        <div class="form-group">
                            <label for=''>Members</label>
                            {!! Form::textarea('members',!empty($project->members)?$project->members:'',['id'=>'members','class' => 'form-control area', 'required'=>'','placeholder'=>'Members','value'=>'[]' ]) !!}
                        </div><div class="form-group">
                            <label for=''></label>
                            {!! Form::hidden('ids',!empty($project->user_ids)?$project->user_ids:'',['id'=>'ids']) !!}
                        </div>
                    <div class="form-group">
                        <label for=''>Select a User</label>
                        {{--{!! Form::select('users', $users, '',['id'=>'user','class' => 'form-control', 'required'=>'' ]) !!}--}}
                        <select id="user" class="form-control">
                            @foreach($users as $k)
                            <option value="{{$k->id}}">{{$k->name}} ({{$k->email}}) </option>
                            @endforeach
                        </select>
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
        var ids=[];

        var names=[];
        var id=$('#ids');
        ids= id.val()?$.parseJSON(id.val()):[];
        console.log(ids);
        var tags=$('#members').tagsInput({'defaultText':'','onRemoveTag':onRemoveTag});
        $('#user').on('change', function() {
             var text=$('#user option:selected').text();
             var value=$('#user option:selected').val();

            if(tags.tagExist($.trim(text))){
                alert(text+" is already exists.")
            }else {
                tags.addTag(text);
                ids.push({"text":text,"user_id":value});
                id.val('');
                id.val(JSON.stringify(ids));
                console.log(ids);
            }
        });


        function onRemoveTag(tag) {
           // console.log(ele);

            //ids.slice($.inArray(tag,ids),1)
             //console.log($.isArray(ids));
               //console.log(ids.trim());
//            for(var i in ids){
//                console.log(i);
//                if($.trim(i)== $.trim(tag)){
//                    delete ids[i];
//                }
//            }
             //console.log(ids);
             //ids= $.parseJSON(id.val());
             //console.log(ids);
            //alert(tag);
            //JSON.parse(ids);
            //console.log(tag);
            for(var i=0;i<ids.length;i++){
                  //console.log(ids[i].text);

                if(($.trim(ids[i].text) == $.trim( tag))) {
                    ids.splice(i, 1);

                }
            }
            //id.val('');
            id.val(JSON.stringify(ids));

            console.log(ids);
        }

    });




</script>
@stop