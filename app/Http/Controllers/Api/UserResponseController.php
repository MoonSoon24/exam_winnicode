<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserResponse;
use Illuminate\Http\Request;

class UserResponseController extends Controller
{
    public function index()
    {
        $responses = UserResponse::with(['user', 'exam', 'question'])->get();
        return response()->json($responses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_exam' => 'required|exists:exams,id_exam',
            'id_question' => 'required|exists:questions,id_questions',
            'user_answer' => 'required|string|max:255',
            'audio_response_path' => 'nullable|string|max:255',
            'is_correct' => 'required|boolean'
        ]);

        $response = UserResponse::create($validated);

        return response()->json([
            'message' => 'User response created successfully',
            'data' => $response
        ]);
    }

    public function show($id)
    {
        $response = UserResponse::with(['user', 'exam', 'question'])->findOrFail($id);
        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $response = UserResponse::findOrFail($id);

        $validated = $request->validate([
            'id_user' => 'sometimes|required|exists:users,id_user',
            'id_exam' => 'sometimes|required|exists:exams,id_exam',
            'id_question' => 'sometimes|required|exists:questions,id_questions',
            'user_answer' => 'sometimes|required|string|max:255',
            'audio_response_path' => 'nullable|string|max:255',
            'is_correct' => 'sometimes|required|boolean'
        ]);

        $response->update($validated);

        return response()->json([
            'message' => 'User response updated successfully',
            'data' => $response
        ]);
    }

    public function destroy($id)
    {
        $response = UserResponse::findOrFail($id);
        $response->delete();

        return response()->json([
            'message' => 'User response deleted successfully'
        ]);
    }
}