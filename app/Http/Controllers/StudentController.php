<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
    public function index(Request $request)
    {
        //real code here 
        // $employees=Student::with('classes')->get();
        
        // if (!Auth::check()) {
        //     return redirect()->route('login')->withErrors([
        //         'email' => 'Please login to access the Student List.',
        //     ])->onlyInput('email');
        // }
    
        // $user = Auth::user();

        // if ($user->role === 'admin') {
        //     return view('admin.students.index', ['emps' => $employees]);
        // } elseif ($user->role === 'teacher') {
        //     return view('teachers.students.index', ['emps' => $employees]);
        // }

        // abort(403, 'Unauthorized action.');


        // TEST CODE


    // Check if the user is authenticated
    // if (!Auth::check()) {
    //     return redirect()->route('login')->withErrors([
    //         'email' => 'Please login to access the Student List.',
    //     ])->onlyInput('email');
    // }

    // $user = Auth::user();

    // // Base query
    // $query = Student::with('classes');

    // // Filter students by class_id using the pivot table
    // if ($request->has('class_id')) {
    //     $query->whereHas('classes', function ($q) use ($request) {
    //         $q->where('class_id', $request->class_id);
    //     });
    // }

    // $students = $query->get();

    // // Render view based on user role
    // if ($user->role === 'admin') {
    //     return view('admin.students.index', ['emps' => $students]);
    // } elseif ($user->role === 'teacher') {
    //     return view('teachers.students.index', ['emps' => $students]);
    // }

    // abort(403, 'Unauthorized action.');




    // test 3 with chatgpt plus

    // $user = Auth::user();

    // // Admin sees all students or filter by class
    // if ($user->role === 'admin') {
    //     $classId = $request->get('class_id');
    //     $emps = Student::when($classId, function ($query) use ($classId) {
    //         $query->whereHas('classes', function ($q) use ($classId) {
    //             $q->where('classes.id', $classId);
    //         });
    //     })->get();

    //     $classes = Classes::all();

    //     return view('admin.students.index', compact('emps', 'classes', 'classId'));
    // }

    // // Teacher
    // $teacher = $user->teacher;
    // $classes = $teacher->classes ?? collect();
    // $classId = $request->get('class_id');
    // $selectedClass = $classes->where('id', $classId)->first() ?? $classes->first();

    // if (!$selectedClass) {
    //     return back()->withErrors(['No classes found.']);
    // }

    // $emps = $selectedClass->students;

    // return view('teachers.students.index', compact('emps', 'selectedClass'));

    
    // test 4 

    // $user = Auth::user();
    // $classId = $request->get('class_id');
    // // $selectedClass = $classes->where('id', $classId)->first() ?? $classes->first();

    // // Load all classes for filter dropdown (admin or teacher)
    // if ($user->role === 'admin') {
    //     $classes = Classes::all();
    // } elseif ($user->role === 'teacher') {
    //     $classes = $user->teacher->classes ?? collect();
    // } else {
    //     abort(403, 'Unauthorized');
    // }

    // // Base query with eager loading
    // $query = Student::with('classes');

    // // Filter by selected class if provided
    // if ($classId) {
    //     $query->whereHas('classes', function ($q) use ($classId) {
    //         $q->where('classes.id', $classId);
    //     });
    // }

    // $emps = $query->get();

    // $teacher = $user->teacher;
    // $classes = $teacher->classes ?? collect();
    // // $classId = $request->get('class_id');
    // $selectedClass = $classes->where('id', $classId)->first() ?? $classes->first();

    // if (!$selectedClass) {
    //     return back()->withErrors(['No classes found.']);
    // }

    // if ($user->role === 'admin') {
    //     return view('admin.students.index', compact('emps', 'classes', 'classId'));
    // } elseif ($user->role === 'teacher') {
    //     return view('teachers.students.index', compact('emps', 'classes', 'selectedClass'));
    // }

    // abort(403, 'Unauthorized');



    // test 5

    $user = Auth::user();
    $classId = $request->get('class_id');

    if ($user->role === 'admin') {
        // Admin can see all classes and all students, filtered optionally
        $classes = Classes::all();

        $query = Student::with('classes');

        if ($classId) {
            $query->whereHas('classes', function ($q) use ($classId) {
                $q->where('classes.id', $classId);
            });
        }

        $emps = $query->get();

        return view('admin.students.index', compact('emps', 'classes', 'classId'));
    }

    // TEACHER role
    if ($user->role === 'teacher') {
        $teacher = $user->teacher;
        $classes = $teacher->classes ?? collect();

        // Pick selected class or default to the first one
        $selectedClass = $classes->where('id', $classId)->first() ?? $classes->first();

        if (!$selectedClass) {
            return back()->withErrors(['No classes found.']);
        }

        $emps = $selectedClass->students;

        return view('teachers.students.index', compact('emps', 'classes', 'selectedClass'));
    }

    abort(403, 'Unauthorized');






        // if(Auth::check()){
        //     return view('admin.students.index',['emps'=>$employees]);
        // }
        // return redirect()->route('login')->withErrors([
        //     'email' => 'Please login to access the Student List.',
        // ])->onlyInput('email');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        // this work 1
        // $depts=Department::get(["id","name"]);
        // return view('employees.create')->with("depts",$depts);
        // $classes = Classes::all();
        // $user = Auth::user();


        
        // return view('admin.students.create')->with("classes",$classes);

        // this works  2
    //     $user = Auth::user();

    // // Get classes based on role
    //     if ($user->role === 'admin') {
    //         $classes = Classes::all(); // Admins can see all classes
    //     } elseif ($user->role === 'teacher') {
    //         $classes = $user->classes; // Teachers can only see their assigned classes
    //     } else {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     // If a class is preselected, find it
    //     $selectedClass = null;
    //     if ($request->has('class_id')) {
    //         $selectedClass = Classes::findOrFail($request->class_id);

    //         // Restrict teachers to only their assigned classes
    //         if ($user->role === 'teacher' && !$user->classes->contains($selectedClass->id)) {
    //             abort(403, 'You do not have access to this class.');
    //         }
    //     }

    //     return view('admin.students.create', compact('classes', 'selectedClass', 'user'));



        // this work
        // $user = Auth::user();

        // if ($user->role === 'teacher') {
        //     $teacher = $user->teacher;
        
        //     if (!$teacher) {
        //         abort(403, 'No teacher profile linked to this user.');
        //     }
        
        //     $classes = $teacher->classes ?? collect();
        
        //     // Get selected class from query or old input (after redirect back)
        //     $classId = $request->get('class_id') ?? old('class_id');
        
        //     $selectedClass = null;
        //     if ($classId) {
        //         $selectedClass = Classes::find($classId);
        
        //         // Validate access
        //         if (!$selectedClass || !$classes->contains($selectedClass->id)) {
        //             abort(403, 'You do not have access to this class.');
        //         }
        //     }
        
        //     return view('teachers.students.create', [
        //         'classes' => $classes,
        //         'selectedClass' => $selectedClass,
        //         'user' => $user
        //     ]);
        // }
        

        // abort(403, 'Unauthorized role.');


        // test 3


        $user = Auth::user();

    if ($user->role === 'admin') {
        $classes = Classes::all();
        return view('admin.students.create', compact('classes'));
    }

    // Teacher
    $teacher = $user->teacher;
    $classes = $teacher->classes ?? collect();
    $classId = $request->get('class_id') ?? old('classes.0');
    $selectedClass = $classes->where('id', $classId)->first() ?? $classes->first();

    if (!$selectedClass) {
        return back()->withErrors(['No classes found.']);
    }

    return view('teachers.students.create', compact('selectedClass'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'eng_name'=>'required|max:50|regex:/^[a-zA-Z\s]+$/',
        //     'kh_name'=>'required|max:50|regex:/^[\p{Khmer}\s]+$/u',
        //     'gender'=>'required|max:25|alpha',
        //     'classes' => 'required|array', // Ensure classes are provided
        //     'classes.*' => 'exists:classes,id', // Validate each class ID
        // ]);
        // $data=$request->except("_token");
        // $employee=Student::create($data);
        // $employee->classes()->sync($request->classes);
        // if($employee) return to_route('students.index');
        // $user = Auth::user();

        // if ($user->role === 'teacher') {
        //     $teacher = $user->teacher;
        //     $classes = $teacher->classes ?? collect();
    
        //     // Try to get class from URL or old input
        //     $classId = $request->get('class_id') ?? old('classes.0');
    
        //     // Try to find selected class from teacher's own classes
        //     $selectedClass = $classes->where('id', $classId)->first();
    
        //     // Fallback to the first class if nothing selected or invalid
        //     if (!$selectedClass && $classes->isNotEmpty()) {
        //         $selectedClass = $classes->first();
        //     }
    
        //     // Final fallback if still null (no class assigned at all)
        //     if (!$selectedClass) {
        //         return back()->withErrors(['error' => 'No class found or assigned to your account.']);
        //     }
    
        //     return view('teacher.students.create', compact('selectedClass'));
        // }
    
        // // Admin view
        // $classes = Classes::all();
        // return view('admin.students.create', compact('classes'));



        // test 3



    //     $user = Auth::user();

    // $request->validate([
    //     'eng_name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
    //     'kh_name' => 'required|max:50|regex:/^[\p{Khmer}\s]+$/u',
    //     'gender' => 'required|max:25|alpha',
    //     'phone' => 'nullable|string|max:20',
    //     'address' => 'nullable|string|max:255',
    //     'classes' => 'required|array',
    //     'classes.*' => 'exists:classes,id',
    // ]);

    // // Check class ownership for teacher
    // if ($user->role === 'teacher') {
    //     $teacher = $user->teacher;
    //     $allowedClassIds = $teacher->classes->pluck('id')->toArray();
    //     foreach ($request->classes as $classId) {
    //         if (!in_array($classId, $allowedClassIds)) {
    //             return back()->withErrors(['classes' => 'You are not allowed to assign to this class.'])->withInput();
    //         }
    //     }
    // }

    // $data = $request->except('_token', 'classes');
    // $student = Student::create($data);
    // $student->classes()->sync($request->classes);

    // // Redirect to class page
    // return redirect()->route('students.index', ['class_id' => $request->classes[0]])
    //     ->with('success', 'Student created successfully!');




    // test 4
    // dd($request->all());

    $user = Auth::user();

    $request->validate([
        'eng_name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
        'kh_name' => 'required|max:50|regex:/^[\p{Khmer}\s]+$/u',
        'gender' => 'required|max:25|alpha',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'classes' => 'required|array',
        'classes.*' => 'exists:classes,id',
    ]);

    // 🔐 For teachers: only allow classes they own
    if ($user->role === 'teacher') {
        $teacher = $user->teacher;
        $allowedClassIds = $teacher->classes->pluck('id')->toArray();
        foreach ($request->classes as $classId) {
            if (!in_array($classId, $allowedClassIds)) {
                return back()->withErrors(['classes' => 'You are not allowed to assign to this class.'])->withInput();
            }
        }
    }
    
    // 📝 Create student and assign to classes
    $student = Student::create([
        'eng_name' => $request->eng_name,
        'kh_name' => $request->kh_name,
        'gender' => $request->gender,
        'phone' => $request->phone,
        'address' => $request->address,
    ]);

    if (!$student) {
        dd('Student was not created.');
    }

    $student->classes()->sync($request->classes); // many-to-many sync
    

    return redirect()->route('students.index', ['class_id' => $request->classes[0]])
        ->with('success', 'Student created successfully!');

       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $emp=Student::findOrfail($id);
        return view('admin.students.details',compact('emp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $emp = Student::with('classes')->findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'admin') {
            $classes = Classes::all();
            return view('admin.students.edit', ['emp' => $emp, 'classes' => $classes]);
        }

        if ($user->role === 'teacher') {
            $teacher = $user->teacher;
            $classes = $teacher->classes ?? collect();

            // Check if the student belongs to a class the teacher teaches
            $studentClassIds = $emp->classes->pluck('id')->toArray();
            $allowedClassIds = $classes->pluck('id')->toArray();
            $commonClassIds = array_intersect($studentClassIds, $allowedClassIds);

            if (empty($commonClassIds)) {
                abort(403, 'You do not have permission to edit this student.');
            }

            $selectedClassId = reset($commonClassIds); // pick first valid class

            return view('teachers.students.edit', [
                'emp' => $emp,
                'selectedClassId' => $selectedClassId
            ]);
        }

        abort(403, 'Unauthorized');

        // $emp=Student::with('classes')->findOrfail($id);
        // $classes = Classes::all();
        // $user = Auth::user();

        // if ($user->role === 'admin') {
        //     return view('admin.students.edit', ['emp' => $emp, 'classes' => $classes]);
        // } elseif ($user->role === 'teacher') {
        //     return view('teachers.students.edit', ['emp' => $emp, 'classes' => $classes]);
        // }
        
        // abort(403, 'Unauthorized');
        // return view('admin.students.edit',compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'eng_name'=>'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'kh_name'=>'required|max:50|regex:/^[\p{Khmer}\s]+$/u',
            'gender'=>'required|max:10',
            'classes' => 'required|array',
            'classes.*' => 'exists:classes,id',
        ]);
    
        $user = Auth::user();
    
        if ($user->role === 'teacher') {
            $teacherClassIds = $user->teacher->classes->pluck('id')->toArray();
            foreach ($request->classes as $classId) {
                if (!in_array($classId, $teacherClassIds)) {
                    return back()->withErrors(['classes' => 'You are not allowed to assign this student to that class.'])->withInput();
                }
            }
        }
    
        $student = Student::findOrFail($id);
    
        $student->update([
            'eng_name' => $request->eng_name,
            'kh_name' => $request->kh_name,
            'gender' => $request->gender
        ]);
    
        $student->classes()->sync($request->classes ?? []);
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');

        // $request->validate([
        //     'eng_name'=>'required|max:50|regex:/^[a-zA-Z\s]+$/',
        //     'kh_name'=>'required|max:50|regex:/^[\p{Khmer}\s]+$/u',
        //     'gender'=>'required|max:10',
        //     'classes' => 'required|array', // Ensure classes are provided
        //     'classes.*' => 'exists:classes,id', // Validate each subject ID
        // ]);
        // // $data=$request->except("_token","_method");
        // // $employee=Student::where('id',$id)->update($data);
        // // if($employee) return to_route('admin.students.index');

        // $student = Student::findOrFail($id);

        // $student->update([
        //     'eng_name' => $request->eng_name,
        //     'kh_name' => $request->kh_name,
        //     'gender' => $request->gender
        // ]);
    
        // // Sync classes (clear if empty)
        // $student->classes()->sync($request->classes ?? []);
    
        // return to_route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emp=Student::findOrfail($id);
        // if($emp->delete()){
        //     return to_route('students.index');
        // }

        $emp->classes()->detach();

        $emp->delete(); // Delete teacher

        return redirect()->route('students.index')->with('success', 'Teacher and linked user deleted successfully!');
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $items = Student::where('first_name', 'LIKE', "%{$query}%")
    //                   ->orWhere('last_name', 'LIKE', "%{$query}%")
    //                   ->get();

    //     return view('admin.students.index', compact('items'));
    // }
}
