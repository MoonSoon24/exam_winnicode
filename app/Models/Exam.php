<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exam';
    protected $primaryKey = 'id_exam';
    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'exam_name',
        'exam_date',
        'exam_due_date',
        'exam_status',
        'exam_time_limit',
        'exam_attempts',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'id_exam');
    }

    public function examDetails()
    {
        return $this->hasMany(ExamDetail::class, 'id_exam');
    }
}
