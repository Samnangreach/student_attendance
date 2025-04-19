<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function classReport(Request $request, $classId)
    {
        $term = $request->input('term');
        $week = $request->input('week');

        $class = Classes::with([
            'students.attendances',
            'students.evaluations' => function ($query) use ($term, $week) {
                if ($term) $query->where('term', $term);
                if ($week) $query->where('week', $week);
                $query->with('subject');
            }
        ])->findOrFail($classId);

        return view('teachers.reports.class', compact('class', 'term', 'week'));
    }


    public function index(Request $request)
    {
        $classes = Classes::all(); // or teacher's classes only

        $class = null;
        $term = $request->term;
        $week = $request->week;

        if ($request->has('class_id')) {
            $class = Classes::with([
                'students.attendances',
                'students.evaluations' => function ($query) use ($term, $week) {
                    if ($term) $query->where('term', $term);
                    if ($week) $query->where('week', $week);
                    $query->with('subject');
                }
            ])->find($request->class_id);
        }

        return view('teachers.reports.index', compact('classes', 'class', 'term', 'week'));
    }
}
