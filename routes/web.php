<?php

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

/** HOME */

Route::get('', [
    'uses' => 'HomeController@getHomeIndex',
    'as' => 'home.index'
]);

/** PLAYERS */

Route::group(['prefix' => 'players'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'PlayerController@getPlayersIndex',
        'as' => 'players.index'
    ]);

    // VIEW

    Route::get('view/{id}', [
        'uses' => 'PlayerController@getPlayersView',
        'as' => 'players.view'
    ]);

    Route::post('view/{id}', [
        'uses' => 'PlayerController@postPlayersView',
        'as' => 'players.view'
    ]);

    // EDIT

    Route::get('edit/{id}', [
        'uses' => 'PlayerController@getPlayersEdit',
        'as' => 'players.edit'
    ]);

    Route::post('edit/{id}', [
        'uses' => 'PlayerController@postPlayersEdit',
        'as' => 'players.edit'
    ]);

    // CREATE

    Route::get('create', [
        'uses' => 'PlayerController@getPlayersCreate',
        'as' => 'players.create'
    ]);

    Route::post('create', [
        'uses' => 'PlayerController@postPlayersCreate',
        'as' => 'players.create'
    ]);

    // FILE

    Route::get('file', [
        'uses' => 'PlayerController@getPlayersFileCreate',
        'as' => 'players.file'
    ]);

    Route::post('file', [
        'uses' => 'PlayerController@postPlayersFileCreate',
        'as' => 'players.file'
    ]);
});

/** TEAMS */

Route::group(['prefix' => 'teams'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'TeamController@getTeamsIndex',
        'as' => 'teams.index'
    ]);

    // VIEW

    Route::get('view/{id}', [
        'uses' => 'TeamController@getTeamsView',
        'as' => 'teams.view'
    ]);

    Route::post('view/{id}', [
        'uses' => 'TeamController@postTeamsView',
        'as' => 'teams.view'
    ]);

    // EDIT

    Route::get('edit/{id}', [
        'uses' => 'TeamController@getTeamsEdit',
        'as' => 'teams.edit'
    ]);

    Route::post('edit/{id}', [
        'uses' => 'TeamController@postTeamsEdit',
        'as' => 'teams.edit'
    ]);

    // CREATE

    Route::get('create', [
        'uses' => 'TeamController@getTeamsCreate',
        'as' => 'teams.create'
    ]);

    Route::post('create', [
        'uses' => 'TeamController@postTeamsCreate',
        'as' => 'teams.create'
    ]);

    // PLAYER

    Route::get('player/{id}', [
        'uses' => 'TeamController@getTeamPlayerView',
        'as' => 'teams.player'
    ]);

    Route::post('player/{id}', [
        'uses' => 'TeamController@postTeamPlayerView',
        'as' => 'teams.player'
    ]);

    // GAME

    Route::get('view/{id}/game', [
        'uses' => 'TeamController@getTeamGameView',
        'as' => 'teams.game'
    ]);

    Route::post('view/{id}/game', [
        'uses' => 'TeamController@postTeamGameView',
        'as' => 'teams.game'
    ]);
});

/** TRADES */

Route::group(['prefix' => 'trades'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'TradeController@getTradesIndex',
        'as' => 'trades.index'
    ]);
});

/** CREATE */

Route::group(['prefix' => 'create'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'HomeController@getCreateIndex',
        'as' => 'create.index'
    ]);
});

/** STATS */

Route::group(['prefix' => 'stats'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'HomeController@getStatsIndex',
        'as' => 'stats.index'
    ]);
});

/** BACKUP */

Route::group(['prefix' => 'backup'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'HomeController@getBackupIndex',
        'as' => 'backup.index'
    ]);
});

