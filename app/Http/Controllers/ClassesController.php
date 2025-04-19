<?php

namespace App\Http\Controllers;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        $class=Classes::get();
        return view('admin.classes.index',['classes'=>$class]);
        // if(Auth::check()){
        //     return view('admin.subjects.index',['sub'=>$class]);
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
        return view('admin.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name'=>'required|max:25|regex:/^[\p{Khmer}a-zA-Z0-9\s\-]+$/u',
            'description'=>'nullable|max:100|regex:/^[a-zA-Z0-9\s\-]+$/',
        ]);
        $data=$request->except("_token");
        $class=Classes::create($data);
        if($class) return to_route('classes.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $sub=Classes::findOrfail($id);
    //     return view('students.details',compact('sub'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class=Classes::findOrfail($id);
        
        return view('admin.classes.edit',compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'class_name'=>'required|max:25|regex:/^[a-zA-Z0-9\s\-]+$/',
            'class_name' => 'required|max:25|regex:/^[\p{Khmer}a-zA-Z0-9\s\-]+$/u',
            'description'=>'nullable|max:100|regex:/^[a-zA-Z0-9\s\-]+$/'
        ]);
        $data=$request->except("_token","_method");
        $class=Classes::where('id',$id)->update($data);
        if($class) return to_route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class=Classes::findOrfail($id);
        if($class->delete()){
            return to_route('classes.index');
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
