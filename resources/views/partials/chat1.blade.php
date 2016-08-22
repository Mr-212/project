
    <style type="text/css">
        .chat
        {
            display:none;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li
        {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li:last-child
        {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: none;
        }

        .chat li.left .chat-body
        {
            margin-left: 60px;
        }

        .chat li.right .chat-body
        {
            margin-right: 60px;
        }


        .chat li .chat-body p
        {
            margin: 0;
            color: #777777;
        }

        .panel .chat
        {
            margin-right: 5px;
        }

        .panel-body
        {
            height: 225px;
        }



        ::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }

        p a {
            text-decoration: underline;
        }
        .container{
            position:fixed;
            bottom: 0;
            padding-right: 30px;
        }
        .join{
            display:none;
        }
        .chat_overflow{
            overflow: auto;
        }

    </style>

    <div class="container" ng-app="chat" ng-controller="chatcontroller"  >
        <div class="row" >
            <div class="col-md-4 col-md-offset-7">

                <div class="join" ng-click="joinChat('{{Auth::user()->name}}')">
                    <button type="button" class="btn btn-default form-control" >join Chat</button>
                </div>

                <div class="chat">
                    <div class="panel panel-primary">
                        <div class="panel-heading window">
                            <span class="glyphicon glyphicon-comment"></span> Chat
                        </div>
                        <div class="chat1">
                            <div class="panel-body chat_overflow " scroll-bottom="data">
                                <div class="" >
                                    <p>Users: <small class=" text-muted"  ng-repeat="users in users track by $index">@{{users.name}},  </small></p>

                                    <li class="right clearfix" ng-repeat="row in data track by $index"><span class="chat-img pull-right"></span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <small class=" text-muted">@{{row.joined}} </small>
                                            </div>
                                            <p><strong class="pull-left primary-font">@{{row.username}} </strong> @{{row.message}}</p>

                                        </div>
                                    </li>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="btn-input" type="text" class="form-control input-sm" ng-model="input" placeholder="Type your message here..." />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat" ng-click="sendMessage()">Send</button>
                            </span>
                                </div>
                            </div>
                            <div class="leave" ng-click="leaveChat('{{\Auth::user()->name}}')">
                                <button type="button" class="btn btn-default form-control" >Leave Chat</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>