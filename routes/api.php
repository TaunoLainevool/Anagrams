<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Anagram;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//List Anagrams
Route::get('anagrams','AnagramController@index');

//Search anagram
Route::get('anagram/{anagram}','AnagramController@show');

//Fetch/
Route::get('fetch','AnagramController@fetch');


