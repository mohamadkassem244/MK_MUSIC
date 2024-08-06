<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    public function index()
    {
        try {
            $countries = Country::all();
            return response()->json($countries);
        } catch (\Exception $e) {
            Log::error('Unable to fetch countries: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch countries.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CountryRequest $request)
    {
        try {
            $country = Country::create($request->validated());
            return response()->json($country, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create country: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create country.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $country_id)
    {
        try {
            $country = Country::findOrFail($country_id);
            return response()->json($country);
        } catch (ModelNotFoundException $e) {
            Log::error('Country not found: ' . $e->getMessage());
            return response()->json(['error' => 'Country not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching country: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch country.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CountryRequest $request, int $country_id)
    {
        try {
            $country = Country::findOrFail($country_id);
            $country->update($request->validated());
            return response()->json($country);
        } catch (ModelNotFoundException $e) {
            Log::error('Country not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'Country not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update country: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update country.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $country_id)
    {
        try {
            $country = Country::findOrFail($country_id);
            $country->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('Country not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'Country not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete country: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete country.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
