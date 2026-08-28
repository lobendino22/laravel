<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/person', function () {
    return view('person');
});

Route::get('/page1/{artist}', function (string $artist) {
    return view('pages.page1', compact('artist'));
})->name('page1');

Route::get('/page2', function () {
    return view('pages.page2');
})->name('page2');

Route::get('/page3', function () {
    return view('pages.page3');
})->name('page3');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');
