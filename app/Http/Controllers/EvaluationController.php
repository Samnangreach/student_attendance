<?php

namespace App\Http\Controllers;
use App\Models\Evaluation;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
    $classId = $request->get('class_id');
    $subjectId = $request->get('subject_id');
    $term = $request->get('term');
    $week = $request->get('week');

    // For Admins
    if ($user->role === 'admin') {
        $classes = Classes::all();

        $query = Evaluation::with('class', 'subject')
            ->when($classId, fn($q) => $q->where('class_id', $classId))
            ->when($subjectId, fn($q) => $q->where('subject_id', $subjectId))
            ->when($term, fn($q) => $q->where('term', $term))
            ->when($week, fn($q) => $q->where('week', $week))
            ->select('date', 'class_id', 'subject_id', 'term', 'week')
            ->groupBy('date', 'class_id', 'subject_id', 'term', 'week')
            ->orderBy('date', 'desc');

        $evaluations = $query->get();

        return view('admin.evaluations.index', compact(
            'evaluations', 'classes', 'classId', 'subjectId', 'term', 'week'
        ));
    }

    // For Teachers
    if ($user->role === 'teacher') {
        $teacher = $user->teacher;
        $classes = $teacher->classes ?? collect();

        // Pick selected class or default to the first one
        $selectedClass = $classes->where('id', $classId)->first() ?? $classes->first();

        if (!$selectedClass) {
            return back()->withErrors(['No classes assigned to you.']);
        }

        $query = Evaluation::with('class', 'subject')
            ->where('class_id', $selectedClass->id)
            ->when($subjectId, fn($q) => $q->where('subject_id', $subjectId))
            ->when($term, fn($q) => $q->where('term', $term))
            ->when($week, fn($q) => $q->where('week', $week))
            ->select('date', 'class_id', 'subject_id', 'term', 'week')
            ->groupBy('date', 'class_id', 'subject_id', 'term', 'week')
            ->orderBy('date', 'desc');

        $evaluations = $query->get();

        return view('teachers.evaluations.index', compact(
            'evaluations', 'classes', 'selectedClass', 'subjectId', 'term', 'week'
        ));
    }

    abort(403, 'Unauthorized');



        // $classId = $request->get('class_id');
        // $subjectId = $request->get('subject_id');
        // $term = $request->get('term');
        // $week = $request->get('week');

        // $query = Evaluation::with('class', 'subject')
        //     ->when($classId, fn($q) => $q->where('class_id', $classId))
        //     ->when($subjectId, fn($q) => $q->where('subject_id', $subjectId))
        //     ->when($term, fn($q) => $q->where('term', $term))
        //     ->when($week, fn($q) => $q->where('week', $week))
        //     ->select('date', 'class_id', 'subject_id', 'term', 'week')
        //     ->groupBy('date', 'class_id', 'subject_id', 'term', 'week')
        //     ->orderBy('date', 'desc');

        // $evaluations = $query->get();

        // $user = Auth::user();
        // $classes = $user->teacher ? $user->teacher->classes : [];

        // return view('teachers.evaluations.index', compact('evaluations', 'term', 'week', 'classes'));

        // $classId = $request->get('class_id');
        // $subjectId = $request->get('subject_id');
        // $term = $request->get('term');
        // $week = $request->get('week');
        // $startDate = $request->get('start_date');
        // $endDate = $request->get('end_date');

        // $query = Evaluation::with('class', 'subject')
        //     ->when($classId, fn($q) => $q->where('class_id', $classId))
        //     ->when($subjectId, fn($q) => $q->where('subject_id', $subjectId))
        //     ->when($term, fn($q) => $q->where('term', $term))
        //     ->when($week, fn($q) => $q->where('week', $week))
        //     ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
        //     ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
        //     ->select('date', 'class_id', 'subject_id', 'term', 'week')
        //     ->groupBy('date', 'class_id', 'subject_id', 'term', 'week')
        //     ->orderBy('date', 'desc');

        // $evaluations = $query->get();

        // $user = Auth::user();
        // $classes = $user->teacher ? $user->teacher->classes : [];

        // return view('teachers.evaluations.index', compact(
        //     'evaluations', 'term', 'week', 'classId', 'subjectId', 'startDate', 'endDate', 'classes'
        // ));
    }



    public function create(Request $request)
    {

        $classId = $request->get('class_id');
        $subjectId = $request->get('subject_id');
        $date = $request->get('date');
        $term = $request->get('term', 'Term 1');
        $week = $request->get('week', 1);
    
        $user = Auth::user();
        $teacher = $user->teacher;
    
        // ✅ Only show the classes and subjects this teacher is assigned to
        $classes = $teacher ? $teacher->classes : collect();
        $subjects = $teacher ? $teacher->subjects : collect();
    
        // ✅ Load students in that class
        $students = [];
        if ($classId) {
            $students = Student::whereHas('classes', function ($q) use ($classId) {
                $q->where('classes.id', $classId);
            })->get();
        }
        
    
        // ✅ Load existing evaluations
        $existing = Evaluation::where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id');


        

        // if ($existing->isNotEmpty()) {
        //     $firstEval = $existing->first();
        
        //     if (!$request->has('term')) {
        //         $term = $firstEval->term;
        //     }
        
        //     if (!$request->has('week')) {
        //         $week = $firstEval->week;
        //     }
        // }

        if ($existing->isNotEmpty()) {
            $firstEval = $existing->first();
        
            // ✅ Only override term/week if they are not selected in the request
            $term = $request->get('term') ?? $firstEval->term;
            $week = $request->get('week') ?? $firstEval->week;
        }
        

        
        // if ($existing->isNotEmpty()) {
        //     $firstEval = $existing->first();
        //     $term = $firstEval->term;
        //     $week = $firstEval->week;
        // }
            
        // dd($existing->toArray());

    
        return view('teachers.evaluations.create', compact(
            'students', 'classId', 'subjectId', 'date',
            'term', 'week', 'existing', 'classes', 'subjects'
        ));

    // $existing = Evaluation::where('class_id', $classId)
    //     ->where('subject_id', $subjectId)
    //     ->where('date', $date)
    //     ->get()
    //     ->keyBy('student_id');

    // return view('teachers.evaluations.create', compact(
    //     'students', 'classId', 'subjectId', 'date',
    //     'term', 'week', 'existing', 'classes', 'subjects'
    // ));

        // $classId = $request->get('class_id');
        // $subjectId = $request->get('subject_id');
        // $date = $request->get('date');
        // $term = $request->get('term', 'Term 1');
        // $week = $request->get('week', 1);

        // $classes = Classes::all(); // ✅ make sure this matches your model name
        // $subjects = Subject::all();   // (optional) if you're using subject dropdown

        // $students = Student::whereHas('classes', function ($q) use ($classId) {
        //     $q->where('classes.id', $classId); // or 'ClassId' if you're using custom column names
        // })->get();

        // $teachers = Teacher::whereHas('subjects', function ($q) use ($subjectId) {
        //     $q->where('subjects.id', $subjectId); // test 
        // })->get();

        // $existing = Evaluation::where('class_id', $classId)
        //     ->where('subject_id', $subjectId)
        //     ->where('date', $date)
        //     ->get()
        //     ->keyBy('student_id');

        // return view('teachers.evaluations.create', compact(
        //     'students', 'classId', 'subjectId', 'date',
        //     'term', 'week', 'existing', 'classes', 'subjects'
        // ));
    }


    public function store(Request $request)
    {
        // foreach ($request->input('students') as $studentData) {
        //     Evaluation::updateOrCreate(
        //         [
        //             'student_id' => $studentData['student_id'],
        //             'subject_id' => $request->subject_id,
        //             'class_id' => $request->class_id,
        //             'date' => $request->date,
        //         ],
        //         [
        //             'classwork' => $studentData['classwork'],
        //             'homework' => $studentData['homework'],
        //             'behavior' => $studentData['behavior'],
        //             'note' => $studentData['note'],
        //             'term' => $request->term,
        //             'week' => $request->week,
        //             'recorded_by' => auth()->id(),
        //         ]
        //     );
        // }
        

        // return redirect()->route('evaluations.index', [
        //     'class_id' => $request->class_id,
        //     'subject_id' => $request->subject_id,
        //     'date' => $request->date,
        // ])->with('success', 'Evaluations saved successfully!');

        // foreach ($request->input('students') as $studentData) {
        //     $exists = Evaluation::where([
        //         'student_id' => $studentData['student_id'],
        //         'subject_id' => $request->subject_id,
        //         'class_id' => $request->class_id,
        //         'date' => $request->date,
        //     ])->exists();
    
        //     if (!$exists) {
        //         Evaluation::create([
        //             'student_id' => $studentData['student_id'],
        //             'subject_id' => $request->subject_id,
        //             'class_id' => $request->class_id,
        //             'date' => $request->date,
        //             'term' => $request->term,
        //             'week' => $request->week,
        //             'classwork' => $studentData['classwork'],
        //             'homework' => $studentData['homework'],
        //             'behavior' => $studentData['behavior'],
        //             'note' => $studentData['note'],
        //             'recorded_by' => auth()->id(),
        //         ]);
        //     }
        // }
    
        // return redirect()->route('evaluations.index')->with('success', 'Evaluations created successfully!');



        $exists = Evaluation::where('class_id', $request->class_id)
        ->where('subject_id', $request->subject_id)
        ->where('date', $request->date)
        ->where('term', $request->term)
        ->where('week', $request->week)
        ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Evaluation for this class, subject, date, term, and week already exists.');
        }

        foreach ($request->input('students') as $studentData) {
            Evaluation::updateOrCreate(
                [
                    'student_id' => $studentData['student_id'],
                    'subject_id' => $request->subject_id,
                    'class_id' => $request->class_id,
                    'date' => $request->date,
                ],
                [
                    'classwork' => $studentData['classwork'],
                    'homework' => $studentData['homework'],
                    'behavior' => $studentData['behavior'],
                    'note' => $studentData['note'],
                    'term' => $request->term,
                    'week' => $request->week,
                    'recorded_by' => auth()->id(),
                ]
            );
        }

        return redirect()->route('evaluations.index')->with('success', 'Evaluations saved successfully!');
    }

    public function edit(Request $request, $date)
    {
        $classId = $request->get('class_id');
        $subjectId = $request->get('subject_id');

        $evaluations = Evaluation::where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id');

        // $evaluations = Evaluation::where('class_id', $classId)
        // ->where('subject_id', $subjectId)
        // ->where('date', $date)
        // ->get()
        // ->keyBy(function ($item) {
        //     return (int) $item->student_id; // force the key to be an integer
        // });



        $term = $evaluations->first()->term ?? 'Term 1';
        $week = $evaluations->first()->week ?? 1;

        $students = Student::whereHas('classes', fn ($q) => $q->where('classes.id', $classId))->get();

        $subject = Subject::find($subjectId);
        $class = Classes::find($classId);
       
        


        return view('teachers.evaluations.edit', compact(
            'classId', 'subjectId', 'date', 'term', 'week',
            'students', 'evaluations', 'subject', 'class'
        ));
    }

    public function update(Request $request, $date)
    {
        // foreach ($request->input('students') as $studentData) {
        //     Evaluation::updateOrCreate(
        //         [
        //             'student_id' => $studentData['student_id'],
        //             'subject_id' => $request->subject_id,
        //             'class_id' => $request->class_id,
        //             'date' => $date,
        //         ],
        //         [
        //             'classwork' => $studentData['classwork'],
        //             'homework' => $studentData['homework'],
        //             'behavior' => $studentData['behavior'],
        //             'note' => $studentData['note'],
        //             'term' => $request->term,
        //             'week' => $request->week,
        //             'recorded_by' => auth()->id(),
        //         ]
        //     );
        // }

        // return redirect()->route('evaluations.index')->with('success', 'Evaluations updated successfully!');
        $request->validate([
            'students.*.student_id' => 'required|integer|exists:students,id',
            'students.*.Classwork' => 'required|numeric',
            'students.*.Homework' => 'nullable|numeric',
            'students.*.Behavior' => 'nullable|string',
            'students.*.Note' => 'nullable|string',
        ]);
        
        
        foreach ($request->input('students') as $studentData) {
            Evaluation::updateOrCreate(
                [
                    'student_id' => $studentData['student_id'],
                    'subject_id' => $request->subject_id,
                    'class_id' => $request->class_id,
                    'date' => $date,
                ],
                [
                    'classwork' => $studentData['Classwork'] ?? null,
                    'homework' => $studentData['Homework'] ?? null,
                    'behavior' => $studentData['Behavior'] ?? null,
                    'note' => $studentData['Note'] ?? null,
                    'term' => $request->term,
                    'week' => $request->week,
                    'recorded_by' => auth()->id(),
                ]
            );
        }
    
        return redirect()->route('evaluations.index')->with('success', 'Evaluations updated successfully!');
    }




}
