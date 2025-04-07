<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subject=Subject::get();
        return view('admin.subjects.index',['subs'=>$subject]);
        // if(Auth::check()){
        //     return view('admin.subjects.index',['sub'=>$subject]);
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
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_name'=>'required|max:25|regex:/^[a-zA-Z\s]+$/',
            'description'=>'nullable|max:100|string',
        ]);
        $data=$request->except("_token");
        $subject=Subject::create($data);
        if($subject) return to_route('subjects.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $sub=Subject::findOrfail($id);
    //     return view('students.details',compact('sub'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sub=Subject::findOrfail($id);
        
        return view('admin.subjects.edit',compact('sub'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_name'=>'required|max:25|alpha',
            'description'=>'nullable|max:100|alpha'
        ]);
        $data=$request->except("_token","_method");
        $subject=Subject::where('id',$id)->update($data);
        if($subject) return to_route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emp=Subject::findOrfail($id);
        if($emp->delete()){
            return to_route('subjects.index');
        }
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $items = Student::where('first_name', 'LIKE', "%{$query}%")
    //                   ->orWhere('last_name', 'LIKE', "%{$query}%")
    //                   ->get();

    //     return view('students.index', compact('items'));
    // }
}
