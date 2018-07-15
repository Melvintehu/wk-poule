<?php

// Match
Route::get('/match/{match}', 'MatchController@show');
Route::get('/match', 'MatchController@index');

// Team
Route::get('/team/{team}', 'TeamController@show');

// Prediction
Route::post('/prediction/match/{match}', 'MatchPredictionController@store');

// Score
Route::get('/user/{user}/score', 'UserScoreController@show');