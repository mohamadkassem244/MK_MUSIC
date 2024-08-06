<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
    public function index()
    {
        try {
            $genres = Genre::all();
            return response()->json($genres);
        } catch (\Exception $e) {
            Log::error('Unable to fetch genres: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch genres.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(GenreRequest $request)
    {
        try {
            $genre = Genre::create($request->validated());
            return response()->json($genre, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create genre: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create genre.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $genre_id)
    {
        try {
            $genre = Genre::findOrFail($genre_id);
            return response()->json($genre);
        } catch (ModelNotFoundException $e) {
            Log::error('Genre not found: ' . $e->getMessage());
            return response()->json(['error' => 'Genre not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching genre: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch genre.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(GenreRequest $request, int $genre_id)
    {
        try {
            $genre = Genre::findOrFail($genre_id);
            $genre->update($request->validated());
            return response()->json($genre);
        } catch (ModelNotFoundException $e) {
            Log::error('Genre not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'Genre not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update genre: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update genre.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $genre_id)
    {
        try {
            $genre = Genre::findOrFail($genre_id);
            $genre->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('Genre not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'Genre not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete genre: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete genre.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
