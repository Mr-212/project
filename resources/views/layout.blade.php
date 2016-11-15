<!DOCTYPE html>
<html lang="en">
<?php isset($active)? $active:null;  ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project Management</title>
      
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/jquery-ui.min.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="/css/plugins/timeline.css" rel="stylesheet">
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/plugins/morris.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/css/plugins/dataTables.responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="/bower_components/angular-datatables/dist/css/angular-datatables.css">
    <script src="/bower_components/ng-table/dist/ng-table.min.css"></script>
    <link rel="stylesheet" type="text/css" href="/js/jtags/dist/jquery.tagsinput.min.css" />

    @yield('css')


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Project Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li>
                    <a  href="#" id="showchat"><i class="fa fa-comments fa-fw"></i> Chat</a>
                </li>
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/user/profile/"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        @if(\Auth::user()->type=='Admin')
                        <li><a href="/setting"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        @endif
                        <li class="divider"></li>
                        <li><a href="/public/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                               
                            
                            <!-- /.nav-second-level -->
                       
                        <!--// projects-->
                        <li>
                            <a  @if($active=='project')class="active" @endif href="/project"><i class="fa fa-folder-open fa-fw"></i> Projects</a>

                        </li>
                        <!--// Sprints-->
                        <li>
                            <a @if($active=='sprint')class="active" @endif href="/sprint"><i class="fa fa-list fa-fw"></i> Sprints</a>

                        </li>
                        <!--// Tasks-->
                        <li>
                            <a @if($active=='task')class="active" @endif href="/task"><i class="fa fa-tasks fa-fw"></i> Tasks</a>
                            {{--<ul class="nav nav-second-level">--}}


                            {{--</ul>--}}
                        </li>

                        @if(\Auth::user()->type=='Admin')
                        <li><!--
-->                            <a @if($active=='setting')class="active" @endif href="/setting"><i class="fa fa-gear fa-fw"></i> Settings</a><!--
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a @if($active=='user')class="active" @endif href="/user"><i class="fa fa-user fa-fw"></i>Users</a>
                        </li>
                         @endif
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
            @include('flash::message')

            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>
              {{$error}}
            </div>
            @endforeach
            @yield('content')

                @include('partials.chat1')


        </div>


    </div>




    <!-- jQuery Version 1.11.0 -->
    <script src="/js/jquery-1.11.0.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="/js/plugins/morris/raphael.min.js"></script>
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/sb-admin-2.js"></script>
    <script src="/js/jtags/dist/jquery.tagsinput.min.js"></script>

    {{--<script src="/bower_components/jquery.countdown/dist/jquery.countdown.js"></script>--}}



    <!-- Angular js -->
    <script src="http://www.pm.local:3000/socket.io/socket.io.js/"></script>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular/angular.min.js"></script>

    <script src="/bower_components/angular-route/angular-route.js"></script>
    <script src="/bower_components/angular-route/angular-route.min.js"></script>
    {{--<script src="/bower_components/ng-scroll-glue/dist/ng-scroll-glue.js"></script>--}}
    <script src="/bower_components/angular-scroll-glue/src/scrollglue.js"></script>
    <script src="/bower_components/angular-countdown/directive/countdownTimer.js"></script>
    <script src="/bower_components/angular-datatables/dist/angular-datatables.min.js"></script>
    {{--<script src="/bower_components/ng-table/changelog.js"></script>--}}
    <script src="/bower_components/ng-table/dist/ng-table.min.js"></script>
    <script src="/angular/chat.js"></script>


    @yield('js')


</body>

</html>

