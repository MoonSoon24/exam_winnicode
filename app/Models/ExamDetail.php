<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDetail extends Model
{
    use HasFactory;

    protected $table = 'exam_details';
    protected $primaryKey = 'id_exam_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_exam',
        'exam_score',
        'time_taken',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id_exam');
    }
}
