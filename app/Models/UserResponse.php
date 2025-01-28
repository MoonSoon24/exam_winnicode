<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    use HasFactory;

    protected $table = 'user_responses';
    protected $primaryKey = 'id_user_response';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_exam',
        'id_question',
        'user_answer',
        'audio_response_path',
        'is_correct',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id_exam');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }
}
