<?php

use App\Framework\Route;
use App\Http\Controllers\UserController;

Route::get('/test', function (){
    return view('layouts.master');
});

Route::get('users',[UserController::class,'index']);
Route::get('',function (){
    return 'bos';
});

Route::get('/array', function (){
    $names = [
        'Rahim1',
        'Rahim2',
        'Rahim3'
    ];
    print_r($names);
});

Route::post('/testz', function (){
    echo 'testz';
});