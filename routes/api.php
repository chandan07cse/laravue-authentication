<?php

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');
Route::post('/logout','AuthController@logout');
Route::post('/registration/confirmed','AuthController@email_verification_confirmed');
Route::post('/send_reset_pass_link','AuthController@send_reset_pass_link');
Route::post('/reset/pass','AuthController@check_pass_reset_token');
Route::post('/resetting/password','AuthController@reset_password');
Route::delete('/delete/user/{id}','AuthController@destroy');

