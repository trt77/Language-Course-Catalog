<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'education',
        'phone',
        'email',
        'picture',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
