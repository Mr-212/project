<?php 
  $type = isset($type)?$type:"primary"; 
  $button = isset($button)?$button:"OK"; 
?>
<div class="modal-header bg-{{$type}}">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title" id="myModalLabel">{{$title}}</h4>
</div>
<div class="modal-body">
  <div class='row'>
    <div class='col-xs-12 col-centered'>
      {{$message}}
    </div>
  </div>
</div>
<div class="modal-footer">
    <a href='#' class='btn btn-{{$type}}' data-dismiss="modal">{{$button}}</a>
</div>
