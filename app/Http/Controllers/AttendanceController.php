<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->get('date', today()->format('Y-m-d'));
        $classId = $request->get('class_id');
        
        $classes = ClassModel::all();
        $students = Student::when($classId, function($query, $classId) {
            return $query->where('class_id', $classId);
        })->with(['attendances' => function($query) use ($selectedDate) {
            $query->whereDate('date', $selectedDate);
        }])->get();

        return view('attendances.index', compact('students', 'classes', 'selectedDate', 'classId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,sick,permission',
            'note' => 'nullable|string',
        ]);

        // Check if attendance already exists for this student and date
        $existingAttendance = Attendance::where('student_id', $request->student_id)
            ->whereDate('date', $request->date)
            ->first();

        if ($existingAttendance) {
            $existingAttendance->update($request->all());
            $message = 'Kehadiran berhasil diperbarui.';
        } else {
            Attendance::create($request->all());
            $message = 'Kehadiran berhasil dicatat.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function report(Request $request)
    {
        $month = $request->get('month', date('Y-m'));
        $classId = $request->get('class_id');

        $startDate = Carbon::parse($month)->startOfMonth();
        $endDate = Carbon::parse($month)->endOfMonth();

        $students = Student::when($classId, function($query, $classId) {
            return $query->where('class_id', $classId);
        })->with(['attendances' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }])->get();

        $classes = ClassModel::all();

        return view('attendances.report', compact('students', 'classes', 'month', 'classId'));
    }
}