<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middlewareGroups'=>'web'], function(){
    Route::get('/', function () {
    return redirect('/public/login');
});
    Route::controller('public','PublicController');
});

Route::group(['middlewareGroups'=>['web', 'auth']], function(){
    Route::controller('setting','CompanyController');
    Route::controller('user','UserController');
    Route::controller('project','ProjectController');
    Route::controller('sprint','SprintController');
    Route::controller('task','TaskController',
        [
            'ajax' => 'getAjax',
        ]);
    Route::controller('file','FileController');
    Route::controller('chat','ChatController',
        [
            'sendMessage'=>'postSendmessage',

        ]);


});

