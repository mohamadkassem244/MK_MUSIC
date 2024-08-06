<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function index()
    {
        try {
            $languages = Language::all();
            return response()->json($languages);
        } catch (\Exception $e) {
            Log::error('Unable to fetch languages: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch languages.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(LanguageRequest $request)
    {
        try {
            $language = Language::create($request->validated());
            return response()->json($language, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create language: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create language.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $language_id)
    {
        try {
            $language = Language::findOrFail($language_id);
            return response()->json($language);
        } catch (ModelNotFoundException $e) {
            Log::error('Language not found: ' . $e->getMessage());
            return response()->json(['error' => 'Language not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching language: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch language.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(LanguageRequest $request, int $language_id)
    {
        try {
            $language = Language::findOrFail($language_id);
            $language->update($request->validated());
            return response()->json($language);
        } catch (ModelNotFoundException $e) {
            Log::error('Language not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'Language not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update language: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update language.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $language_id)
    {
        try {
            $language = Language::findOrFail($language_id);
            $language->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('Language not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'Language not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete language: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete language.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
