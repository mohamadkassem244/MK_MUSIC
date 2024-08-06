<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistRequest;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PlaylistController extends Controller
{
    public function index()
    {
        try {
            $playlists = Playlist::all();
            return response()->json($playlists);
        } catch (\Exception $e) {
            Log::error('Unable to fetch playlists: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch playlists.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(PlaylistRequest $request)
    {
        try {
            $playlist = Playlist::create($request->validated());
            return response()->json($playlist, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create playlist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $playlist_id)
    {
        try {
            $playlist = Playlist::findOrFail($playlist_id);
            return response()->json($playlist);
        } catch (ModelNotFoundException $e) {
            Log::error('Playlist not found: ' . $e->getMessage());
            return response()->json(['error' => 'Playlist not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch playlist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(PlaylistRequest $request, int $playlist_id)
    {
        try {
            $playlist = Playlist::findOrFail($playlist_id);
            $playlist->update($request->validated());
            return response()->json($playlist);
        } catch (ModelNotFoundException $e) {
            Log::error('Playlist not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'Playlist not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update playlist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $playlist_id)
    {
        try {
            $playlist = Playlist::findOrFail($playlist_id);
            $playlist->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('Playlist not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'Playlist not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete playlist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
