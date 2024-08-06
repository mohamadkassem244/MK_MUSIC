<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{
    public function index()
    {
        try {
            $albums = Album::all();
            return response()->json($albums);
        } catch (\Exception $e) {
            Log::error('Unable to fetch albums: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch albums.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(AlbumRequest $request)
    {
        try {
            $album = Album::create($request->validated());
            return response()->json($album, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create album: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create album.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $album_id)
    {
        try {
            $album = Album::findOrFail($album_id);
            return response()->json($album);
        } catch (ModelNotFoundException $e) {
            Log::error('Album not found: ' . $e->getMessage());
            return response()->json(['error' => 'Album not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching album: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch album.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(AlbumRequest $request, int $album_id)
    {
        try {
            $album = Album::findOrFail($album_id);
            $album->update($request->validated());
            return response()->json($album);
        } catch (ModelNotFoundException $e) {
            Log::error('Album not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'Album not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update album: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update album.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $album_id)
    {
        try {
            $album = Album::findOrFail($album_id);
            $album->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('Album not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'Album not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete album: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete album.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
