<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'no_telp',
        'alamat',
    ];

    public function examDetails()
    {
        return $this->hasMany(ExamDetail::class, 'id_user');
    }

    public function responses()
    {
        return $this->hasMany(UserResponse::class, 'id_user');
    }
}
