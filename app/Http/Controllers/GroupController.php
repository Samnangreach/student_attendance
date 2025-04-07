<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {

        $groups = Group::with(['students', 'class'])->get();
    
        return view('admin.groups.index', ['groups' => $groups]);

        // $group=Group::with('students')->get();
        // return view('admin.groups.index',['groups'=>$group]);
        // if(Auth::check()){
        //     return view('admin.subjects.index',['sub'=>$group]);
        // }
        // return redirect()->route('login')->withErrors([
        //     'email' => 'Please login to access the Student List.',
        // ])->onlyInput('email');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $depts=Department::get(["id","name"]);
        // return view('employees.create')->with("depts",$depts);
        $students=Student::get();
        $classes=Classes::get();

        return view('admin.groups.create',compact('students','classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'class_name'=>'required|max:25|regex:/^[a-zA-Z0-9\s\-]+$/',
        //     'description'=>'nullable|max:100|regex:/^[a-zA-Z0-9\s\-]+$/',
        //     'eng_name' => 'required|array', // Ensure subjects are provided
        //     'eng_name.*' => 'exists:students,id', // Validate each student ID
        // ]);
        // $data=$request->except("_token");
        // $group=Group::create($data);
        // if($group) return to_route('classes.index');

        $request->validate([
            'group_name' => 'required|max:25|regex:/^[a-zA-Z0-9\s\-]+$/',
            'class_id' => 'required|exists:classes,id',
            'description' => 'nullable|max:100|regex:/^[a-zA-Z0-9\s\-]+$/',
            'students' => 'required|array',
            'students.*' => 'exists:students,id',
        ]);
    
        $group = Group::create([
            'group_name' => $request->group_name,
            'class_id' => $request->class_id,  // Ensure this matches the DB column
            'description' => $request->description,
        ]);
    
        
        // Attach students to the group
        $group->students()->attach($request->students);
    
        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $sub=Group::findOrfail($id);
    //     return view('students.details',compact('sub'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $group=Group::findOrfail($id);
        $students = Student::all();
        $classes = Classes::all(); 
        
        return view('admin.groups.edit',compact('group', 'students', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name'=>'required|max:25|regex:/^[a-zA-Z0-9\s\-]+$/',
            'description'=>'nullable|max:100|regex:/^[a-zA-Z0-9\s\-]+$/'
        ]);
        $data=$request->except("_token","_method");
        $group=Group::where('id',$id)->update($data);
        if($group) return to_route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group=Group::findOrfail($id);
        if($group->delete()){
            return to_route('classes.index');
        }
    }
}
