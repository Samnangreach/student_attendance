<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $schedules = Schedule::with(['teacher', 'class', 'subject'])
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();

            return view('admin.schedules.index', compact('schedules'));
        }

        if ($user->role === 'teacher') {
            $teacher = $user->teacher;

            $schedules = Schedule::with(['class', 'subject'])
                ->where('teacher_id', $teacher->id)
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();

            return view('teachers.schedules.index', compact('schedules'));
        }

        abort(403, 'Unauthorized');
    }

    public function create()
    {
        $teachers = Teacher::all();
        $classes = Classes::all();
        $subjects = Subject::all();

        return view('admin.schedules.create', compact('teachers', 'classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }


    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $teachers = Teacher::all();
        $classes = Classes::all();
        $subjects = Subject::all();

        return view('admin.schedules.edit', compact('schedule', 'teachers', 'classes', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }




}
