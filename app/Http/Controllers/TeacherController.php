<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Class_;

class TeacherController extends Controller
{
    public function index()
    {
        // $teachers=Teacher::with('subjects')->get();
        $teachers = Teacher::with(['subjects', 'classes'])->get();
        $user = Auth::user();
        if(Auth::check()){
            return view('admin.teachers.index',['teas'=>$teachers, 'user'=>$user]);
        }
        return redirect()->route('login')->withErrors([
            'email' => 'Please login to access the Teacher List.',
        ])->onlyInput('email');   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subs = Subject::all();
        $classes = Classes::all();
        // $depts=Department::get(["id","name"]);
        // return view('teachers.create')->with("depts",$depts);
        return view('admin.teachers.create', compact('subs', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $request->validate([
             'teacher_name' => 'required|string|max:50',
             'email' => 'required|email|unique:users,email|unique:teachers,email',
             'gender' => 'required|string|max:10',
             'phone' => 'required|string|max:50',
             'address' => 'required|string|max:150',
             'password' => 'required|min:6',
             'subjects' => 'required|array', // Ensure subjects are provided
             'subjects.*' => 'exists:subjects,id', // Validate each subject ID
             'classes' => 'required|array', // Ensure classes are provided
             'classes.*' => 'exists:classes,id', // Validate each class ID
         ]);
     
         try {
             DB::beginTransaction();
     
             // Create user with "teacher" role
             $user = User::create([
                 'name' => $request->teacher_name,
                 'email' => $request->email,
                 'password' => Hash::make($request->password),
                 'role' => 'teacher',
             ]);
     
             // Prepare teacher data excluding token and password
             $teacherData = $request->except('_token', 'password');
             $teacherData['user_id'] = $user->id;
     
             // Create teacher linked to user
             $teacher = Teacher::create($teacherData);
             // Attach selected subjects to the teacher
            //  $teacher->subjects()->attach($request->subjects);
            $teacher->subjects()->sync($request->subjects);
            // Attach selected classes to the teacher
            $teacher->classes()->sync($request->classes);
            
     
             DB::commit();
     
             return to_route('teachers.index')->with('success', 'Teacher created successfully');
         } catch (\Exception $e) {
             DB::rollBack();
             return back()->with('error', 'Failed to create teacher: ' . $e->getMessage());
         }
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tea = Teacher::with('subjects')->findOrFail($id);
        $subs = Subject::all();
        
        return view('admin.teachers.details',compact('tea','subs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $tea=Teacher::findOrfail($id);
        $tea = Teacher::with('subjects')->findOrFail($id);
        $subs = Subject::all();
        $classes = Classes::all();
        
        return view('admin.teachers.edit',compact('tea','subs', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'teacher_name'=>'required|max:50|alpha',
        //     'email'=>'required|max:50|alpha'
        // ]);
        // $data=$request->except("_token","_method");
        // $teacher=Teacher::where('id',$id)->update($data);
        // if($teacher) return to_route('teachers.index');
        $request->validate([
            'teacher_name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:50|unique:teachers,email,' . $id . ',id',
            'password' => 'nullable|min:6|confirmed', // Password is optional but must be at least 6 characters if provided
            'subjects' => 'nullable|array', // Ensure subjects is an array
            'subjects.*' => 'exists:subjects,id', // Each subject ID must exist in the subjects table
             'classes' => 'nullable|array', // ✅ Validate classes too
            'classes.*' => 'exists:classes,id'
        ]);
    
        // Find the teacher
        $teacher = Teacher::findOrFail($id);
    
        // Update the teacher's details
        $teacher->update([
            'teacher_name' => $request->teacher_name,
            'email' => $request->email
        ]);
    
        // Update the corresponding user details
        if ($teacher->user_id) {
            $user = User::find($teacher->user_id);
            if ($user) {
                $user->update([
                    'name' => $request->teacher_name,
                    'email' => $request->email,
                    'password' => $request->password ? Hash::make($request->password) : $user->password, // Update password only if provided
                ]);
            }
        }

        if ($request->has('subjects')) {
            $teacher->subjects()->sync($request->subjects); // Sync subjects to update the pivot table
        }

        if ($request->has('classes')) {
            $teacher->classes()->sync($request->classes);
        }
    
        return to_route('teachers.index')->withSuccess('Teacher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $emp=Teacher::findOrfail($id);
    //     if($emp->delete()){
    //         return to_route('teachers.index');
    //     }
    // }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->classes()->detach();
        $teacher->subjects()->detach();

        if ($teacher->user) {
            $teacher->user->delete(); // Delete linked user
        }

        $teacher->delete(); // Delete teacher

        return redirect()->route('teachers.index')->with('success', 'Teacher and linked user deleted successfully!');
    }

}
