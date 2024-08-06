<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackRequest;
use App\Models\Track;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TrackController extends Controller
{
    public function index()
    {
        try {
            $tracks = Track::all();
            return response()->json($tracks);
        } catch (\Exception $e) {
            Log::error('Unable to fetch tracks: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch tracks.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(TrackRequest $request)
    {
        try {
            $track = Track::create($request->validated());
            return response()->json($track, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create track: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create track.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $track_id)
    {
        try {
            $track = Track::findOrFail($track_id);
            return response()->json($track);
        } catch (ModelNotFoundException $e) {
            Log::error('Track not found: ' . $e->getMessage());
            return response()->json(['error' => 'Track not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching track: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch track.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(TrackRequest $request, int $track_id)
    {
        try {
            $track = Track::findOrFail($track_id);
            $track->update($request->validated());
            return response()->json($track);
        } catch (ModelNotFoundException $e) {
            Log::error('Track not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'Track not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update track: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update track.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $track_id)
    {
        try {
            $track = Track::findOrFail($track_id);
            $track->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('Track not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'Track not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete track: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete track.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
