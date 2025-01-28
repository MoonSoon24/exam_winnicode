<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer'
        ]);

        $exam = Exam::create($validated);

        return response()->json([
            'message' => 'Exam created successfully',
            'data' => $exam
        ]);
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'sometimes|required|integer'
        ]);

        $exam->update($validated);

        return response()->json([
            'message' => 'Exam updated successfully',
            'data' => $exam
        ]);
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return response()->json([
            'message' => 'Exam deleted successfully'
        ]);
    }

    public function startExam($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);

        return response()->json([
            'id' => $exam->id_exam,
            'title' => $exam->exam_name,
            'duration' => $exam->exam_time_limit,
            'questions' => $exam->questions->map(function ($question) {
                return [
                    'id' => $question->id_questions,
                    'question_text' => $question->question_text,
                    'options' => is_string($question->question_options) 
                        ? json_decode($question->question_options, true) 
                        : $question->question_options,
                    'correct_answer' => $question->answer,
                ];
            }),
        ]);
    }
}