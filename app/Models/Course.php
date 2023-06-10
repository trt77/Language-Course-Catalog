<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'language',
        'teacher_id',
        'schedule_id',
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourites', 'course_id', 'user_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function enrolled_users()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }
}
