<?php

Route::resource('user', $api_namespace . 'UserController');
Route::get('test/roles', $api_namespace . 'UserRoleController@roles');
?>