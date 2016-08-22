
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">File View</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>File</th>
                                    <th width="200">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                 @if (isset($files))
                                    @foreach($files as $file)
                                        <tr>
                                            <td>{{($file->name)}}</td>
                                            <td>
                                                <a class='btn btn-primary btn-xs' href="/file/view/{{$file->id}}" ><i class="fa fa-file-picture-o"></i> View</a>
                                                <a class='btn btn-primary btn-xs' href="/file/download/{{$file->id}}" ><i class="fa fa-download"></i></a>
                                                <a class='btn btn-primary btn-xs' href="/file/delete/{{$file->id}}" ><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                 @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>


