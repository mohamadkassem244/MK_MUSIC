<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistRequest;
use App\Models\Artist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ArtistController extends Controller
{
    public function index()
    {
        try {
            $artists = Artist::all();
            return response()->json($artists);
        } catch (\Exception $e) {
            Log::error('Unable to fetch artists: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch artists.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ArtistRequest $request)
    {
        try {
            $artist = Artist::create($request->validated());
            return response()->json($artist, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create artist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create artist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $artist_id)
    {
        try {
            $artist = Artist::findOrFail($artist_id);
            return response()->json($artist);
        } catch (ModelNotFoundException $e) {
            Log::error('Artist not found: ' . $e->getMessage());
            return response()->json(['error' => 'Artist not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching artist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch artist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(ArtistRequest $request, int $artist_id)
    {
        try {
            $artist = Artist::findOrFail($artist_id);
            $artist->update($request->validated());
            return response()->json($artist);
        } catch (ModelNotFoundException $e) {
            Log::error('Artist not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'Artist not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update artist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update artist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $artist_id)
    {
        try {
            $artist = Artist::findOrFail($artist_id);
            $artist->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('Artist not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'Artist not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete artist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete artist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
