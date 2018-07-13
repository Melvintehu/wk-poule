<?php

// --- CORE ROUTES ONLY
Route::get('/profile/edit', $cms_namespace . 'ProfileController@edit');
Route::get('/logout', $cms_namespace . 'LogoutController@logout');
Route::get('/', $cms_namespace . 'DashBoardController@index');
Route::get('/edit', $cms_namespace . 'FrontController@edit');

// ----------------- Plugin entry point ----------
// Route::get('/plugin', $cms_namespace . 'FrontController@plugin');


// --- CORE POSt ROUTES ONLY
Route::post('/step1', $cms_namespace . 'SetupController@step1');

// ----------------- GENERIC ROUTES FOR EVERY PROJECT GO HERE ----------


// ------ CUSTOM ROUTES GO UNDERNEATH HERE ----------------
Route::resource('entity', $cms_namespace . 'FrontController');

?>