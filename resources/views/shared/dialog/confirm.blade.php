<?php
$type   =isset($type)?$type:'primary';
$button =isset($button)?$button:'OK';
$method =isset($method)?$method:'POST';
?>

<div class="modal-header bg-{{$type}}">
    <button type="button" class="close" data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class="sr-only"></span></button>
    <h4 class="modal-title" id='myModelLable'>{{$title}}</h4>
</div>

<div class="modal-body">
  <div class='row'>
    <div class='col-xs-12 col-centered'>
      {{$message}}
    </div>
  </div>
</div>

<div class="modal-footer">
  {!! Form::open(['url' => $action, 'method' => $method ]) !!}
    <button class='btn btn-{{$type}}'>{{$button}}</button>
    <a href='#' data-dismiss="modal">Cancel</a>
  {!! Form::close() !!}
</div>

