<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users);
        } catch (\Exception $e) {
            Log::error('Unable to fetch users: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch users.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            return response()->json($user, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Unable to create user: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create user.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            Log::error('User not found: ' . $e->getMessage());
            return response()->json(['error' => 'User not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch user.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UserRequest $request, int $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->update($request->validated());
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            Log::error('User not found for update: ' . $e->getMessage());
            return response()->json(['error' => 'User not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to update user: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update user.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            Log::error('User not found for deletion: ' . $e->getMessage());
            return response()->json(['error' => 'User not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Unable to delete user: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete user.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
