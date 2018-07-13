<?php

use App\Team;
$auth_namespace = "Auth\\";
$cms_namespace = "cms\\";
$web_namespace = "";
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', function () {
    if(Auth::check()) {
        return redirect('/wedstrijd-overzicht');
    }
    return view('register');
});

Route::get('/', function() {
    return redirect('/stand');
});

Route::get('inloggen', function() {
    if(Auth::check()) {
        return redirect('/wedstrijd-overzicht');
    }
    return view('login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/wedstrijd-overzicht', 'MatchController@index');
    Route::get('/gespeelde-wedstrijden', 'MatchController@played');
    Route::get('/voorspellingsoverzicht', 'MatchController@predictions');
    Route::get('/stand', 'ScoreController@index');

    Route::get('/overige', 'OtherPredictionController@index');
    Route::get('/ronde-voorspellingen', 'TeamPredictionController@getRoundPredictions');

    // voorspellingen
    Route::get('/voorspelling-invoeren/{match}', 'PredictionController@predict');
    Route::post('/voorspelling-bevestigen', 'PredictionController@store');
    
    Route::get('/team-voorspellingen', 'TeamPredictionController@getRound');
    Route::post('/team-voorspellingen', 'TeamPredictionController@insertPredictions');

    Route::get('/top-scoorder', 'PageController@topScorer');
    Route::get('/meeste-tegendoelpunten', 'PageController@mostGoalsAgainstTeam');
    Route::get('/top-scoring-team', 'PageController@topScoringTeam');

    Route::post('/top-scorer', 'PageController@insertTopScorer');
    Route::post('/mostGoalsAgainstTeam', 'PageController@insertMostGoalsAgainstTeam');
    Route::post('/topScoringTeam', 'PageController@insertTopScoringTeam');
});


Route::get('/cropper', 'cms\ImageHelperController@index');
Route::resource('photo', 'cms\PhotosController');
Route::post('photo/multi', 'cms\MultiPhotosController@store');

Route::group(['prefix' => 'cms'],  function () {
    Route::group(['middleware' => ['auth']], function(){

    	// --- CORE ROUTES ONLY
        Route::get('/logout', 'cms\LogoutController@logout');
   		Route::get('/', 'cms\DashBoardController@index');
        Route::get('/edit', 'cms\FrontController@edit');
        // ----------------- GENERIC ROUTES FOR EVERY PROJECT GO HERE ----------


        // ------ CUSTOM ROUTES GO UNDERNEATH HERE ----------------
        Route::resource('entity', 'cms\FrontController');

    });
});

Route::get('home', 'cms\HomeController@index');
Route::get('/cropper', $cms_namespace . 'ImageHelperController@index');
Route::resource('photo', $cms_namespace . 'PhotosController');
Route::post('photo/multi', $cms_namespace . 'MultiPhotosController@store');

Route::group(['prefix' => 'cms'],  function () use ($cms_namespace, $web_namespace, $auth_namespace){
    
    Route::group(['middleware' => ['auth']], function() use ($cms_namespace, $web_namespace, $auth_namespace){
        
        /**
         * Routes for CMS front-end here
         */
        
        foreach (File::glob(base_path('routes/cms/core/*.php')) as $filename) {
            if (isset($filename) && file_exists($filename)) {
                require $filename;
            }
        }
        
    });
});


// POST ROUTES
// Route::post('/register',  'Auth\RegisterController@register');

// Authentication Routes...
Route::get('login', $auth_namespace . 'LoginController@showLoginForm')->name('login');
Route::post('login', $auth_namespace . 'LoginController@login');

// Registration Routes...
Route::post('register', $auth_namespace . 'RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', $auth_namespace . 'ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', $auth_namespace . 'ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', $auth_namespace . 'ResetPasswordController@showResetForm');
Route::post('password/reset', $auth_namespace . 'ResetPasswordController@reset');

Route::get('home', $cms_namespace . 'HomeController@index');