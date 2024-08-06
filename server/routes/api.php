<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user_id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{user_id}', [UserController::class, 'update']);
Route::patch('/users/{user_id}', [UserController::class, 'update']);
Route::delete('/users/{user_id}', [UserController::class, 'destroy']);

Route::get('/artists', [ArtistController::class, 'index']);
Route::get('/artists/{artist_id}', [ArtistController::class, 'show']);
Route::post('/artists', [ArtistController::class, 'store']);
Route::put('/artists/{artist_id}', [ArtistController::class, 'update']);
Route::patch('/artists/{artist_id}', [ArtistController::class, 'update']);
Route::delete('/artists/{artist_id}', [ArtistController::class, 'destroy']);

Route::get('/albums', [AlbumController::class, 'index']);
Route::get('/albums/{album_id}', [AlbumController::class, 'show']);
Route::post('/albums', [AlbumController::class, 'store']);
Route::put('/albums/{album_id}', [AlbumController::class, 'update']);
Route::patch('/albums/{album_id}', [AlbumController::class, 'update']);
Route::delete('/albums/{album_id}', [AlbumController::class, 'destroy']);

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{country_id}', [CountryController::class, 'show']);
Route::post('/countries', [CountryController::class, 'store']);
Route::put('/countries/{country_id}', [CountryController::class, 'update']);
Route::patch('/countries/{country_id}', [CountryController::class, 'update']);
Route::delete('/countries/{country_id}', [CountryController::class, 'destroy']);

Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{genre_id}', [GenreController::class, 'show']);
Route::post('/genres', [GenreController::class, 'store']);
Route::put('/genres/{genre_id}', [GenreController::class, 'update']);
Route::patch('/genres/{genre_id}', [GenreController::class, 'update']);
Route::delete('/genres/{genre_id}', [GenreController::class, 'destroy']);

Route::get('/languages', [LanguageController::class, 'index']);
Route::get('/languages/{language_id}', [LanguageController::class, 'show']);
Route::post('/languages', [LanguageController::class, 'store']);
Route::put('/languages/{language_id}', [LanguageController::class, 'update']);
Route::patch('/languages/{language_id}', [LanguageController::class, 'update']);
Route::delete('/languages/{language_id}', [LanguageController::class, 'destroy']);

Route::get('/playlists', [PlaylistController::class, 'index']);
Route::get('/playlists/{playlist_id}', [PlaylistController::class, 'show']);
Route::post('/playlists', [PlaylistController::class, 'store']);
Route::put('/playlists/{playlist_id}', [PlaylistController::class, 'update']);
Route::patch('/playlists/{playlist_id}', [PlaylistController::class, 'update']);
Route::delete('/playlists/{playlist_id}', [PlaylistController::class, 'destroy']);

Route::get('/tracks', [TrackController::class, 'index']);
Route::get('/tracks/{track_id}', [TrackController::class, 'show']);
Route::post('/tracks', [TrackController::class, 'store']);
Route::put('/tracks/{track_id}', [TrackController::class, 'update']);
Route::patch('/tracks/{track_id}', [TrackController::class, 'update']);
Route::delete('/tracks/{track_id}', [TrackController::class, 'destroy']);
