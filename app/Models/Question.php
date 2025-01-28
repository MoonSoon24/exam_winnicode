<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id_questions';
    public $timestamps = false;

    protected $fillable = [
        'id_exam',
        'question_text',
        'question_options',
        'answer',
    ];

    protected $casts = [
        'question_options' => 'array',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id_exam');
    }
}
