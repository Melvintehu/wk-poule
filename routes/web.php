<?php

// Match
Route::get('/match/{match}', 'MatchController@show')->name('match.show');
Route::get('/match', 'MatchController@index')->name('match.index');
Route::get('/matches/played', 'MatchPlayedController@index')->name('match.played.index');


// Team
Route::get('/team/{team}', 'TeamController@show');

// Prediction
Route::post('/prediction/match/{match}', 'MatchPredictionController@store');

// Score
Route::get('/user/{user}/score', 'UserScoreController@show');