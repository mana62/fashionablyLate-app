<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_sheet_id',
        'start_break',
        'finish_break',
    ];

    public function attendanceSheet()
    {
        return $this->belongsTo(AttendanceSheet::class);
    }
}
