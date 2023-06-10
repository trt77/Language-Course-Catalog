<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'days_of_week', 'time', 'duration', 'facility_id', 'course_id'];

    protected $casts = [
        'days_of_week' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    protected function daysOfWeek(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return str_getcsv(trim($value, '{}'));
            },
            set: function ($value) {
                if (is_array($value)) {
                    return '{'.implode(',', $value).'}';
                } else {
                    return $value;
                }
            }
        );
    }

}
