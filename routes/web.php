<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\StandingController::class, 'index'])->name('home');
Route::resource('team', \App\Http\Controllers\TeamController::class)->only('index', 'show', 'datatable');
Route::resource('match', \App\Http\Controllers\MatchController::class)->only('index', 'datatable');

Route::get('league/advance',[\App\Http\Controllers\LeagueController::class,'advance'])->name('league.advance');
Route::get('league/finish',[\App\Http\Controllers\LeagueController::class,'finish'])->name('league.finish');
