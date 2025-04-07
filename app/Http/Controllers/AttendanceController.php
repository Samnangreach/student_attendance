<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {

        // test code
        
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Please login to access the Student List.',
            ])->onlyInput('email');
        }
    
        
        
        // Fetch students with attendance data
        $students = Student::with('attendances')->get();
    
        // Define the date range for attendance
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $dates = [];
    
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->toDateString(); // Convert date to 'Y-m-d' format
        }
        
        $user = Auth::user();
        // Return different views for Admin and Teacher
        if ($user->role == 'admin') {
            return view('admin.attendances.index', [
                'emps' => $students,
                'dates' => $dates
            ]);
        } elseif ($user->role == 'teacher') {
            return view('teachers.attendances.index', [
                'emps' => $students,
                'dates' => $dates
            ]);
        }
    
        abort(403, 'Unauthorized action.');


        // real code
    //     $students = Student::with('attendances')->get();

    // // Define the date range for attendance
    // $startDate = Carbon::now()->startOfMonth(); // Example: Start of the month
    // $endDate = Carbon::now()->endOfMonth(); // Example: End of the month
    // $dates = [];
    
    // for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //     $dates[] = $date->toDateString(); // Convert date to 'Y-m-d' format
    // }
        
    // if(Auth::check()){
    //     return view('attendances.index', ['emps' => $students, 'dates' => $date]);
    // }
    // return redirect()->route('login')->withErrors([
    //         'email' => 'Please login to access the Attendance List.',
    // ])->onlyInput('email');

    

        // $employees=Attendance::get();
        // return view('attendances.index',['emps'=>$employees]);
        // $employees = Attendance::with('student')->get();
        // return view('attendances.index', ['emps' => $employees]);

        // $students = Student::with('attendances')->get();
        // return view('attendances.index', ['emps' => $students]);

        // $date = $request->input('date', date('Y-m-d')); // Default to today's date if not selected

        // $employees = Attendance::with('student')
        //     ->whereDate('date', $date)
        //     ->get();
        // return view('attendances.index', ['emps' => $employees, 'selectedDate' => $date]);
    }
    

    public function store(Request $request)
    {
        if (!$request->has('attendance')) {
            return back()->withErrors(['error' => 'No attendance data provided!']);
        }
        // Validate the incoming request
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.status' => 'nullable|in:present,late,absent,excused'
        ]);
            // foreach ($request->attendance as $student_id => $data) {
            //     Attendance::updateOrCreate(
            //         ['student_id' => $student_id, 'date' => $request->date],
            //             ['status' => $data['status'] ?? null,
            //             'note' => $data['note'] ?? null,
            //         ]
            //     );
            // }
            foreach ($request->attendance as $student_id => $data) {
                // Set default status if none is selected
                $status = $data['status'] ?? 'absent';
                $note = $data['note'] ?? null;

                $attendance = Attendance::where('student_id', $student_id)
                                ->where('date', $request->date)
                                ->first();
                
                if ($attendance) {
                    // If found, update it
                    $attendance->update([
                        'status' => $status,
                        'note' => $note
                    ]);
                } else {
                    // If not found, create a new record
                    Attendance::create([
                        'student_id' => $student_id,
                        'date' => $request->date,
                        'status' => $status,
                        'note' => $note
                    ]);
                }
                
                // Attendance::updateOrCreate(
                //     ['student_id' => $student_id, 'date' => $request->date],
                //     ['status' => $status, 'note' => $note]
                // );
            }
        
    
            return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
        
    }
    // public function store(Request $request)
    // {
    // $request->validate([
    //     'date' => 'required|date',
    //     'attendance' => 'required|array',
    // ]);

    // foreach ($request->attendance as $student_id => $dates) {
    //     foreach ($dates as $date => $status) {
    //         Attendance::updateOrCreate(
    //             ['student_id' => $student_id, 'date' => $date],
    //             ['status' => $status, 'note' => $request->note[$student_id][$date] ?? null]
    //         );
    //     }
    // }
    // return back()->with('success', 'Attendance updated successfully');

//     foreach ($request->attendance as $student_id => $data) {
//         Attendance::updateOrCreate(
//             ['student_id' => $student_id, 'date' => $request->date],
//             [
//                 'late' => isset($data['late']) ? 1 : 0,
//                 'present' => isset($data['present']) ? 1 : 0,
//                 'absent' => isset($data['absent']) ? 1 : 0,
//                 'excused' => isset($data['excused']) ? 1 : 0,
//                 'note' => $data['note'] ?? null,
//             ]
//         );
//     }

//     return redirect()->route('attendances.index')->with('success', 'Attendance saved successfully!');
// }


    public function create(Request $request )
    {
        // $employees=Student::get();
        // // $depts=Department::get(["id","name"]);
        // // return view('employees.create')->with("depts",$depts);
        // return view('attendances.create',['emps'=>$employees]);
        
        $date = $request->input('date', \Carbon\Carbon::now()->format('y-m-d'));
        $students = Student::all();
        
        // Retrieve attendance records for the selected date
        $attendances = Attendance::where('date', $date)->get()->keyBy('student_id');
        
        $user = Auth::user();

    
        // return view('attendances.create', [
        //     'emps' => $students,
        //     'attendances' => $attendances,
        //     'selectedDate' => $date
        // ]);


        
        if ($user->role === 'admin') {
            return view('admin.attendances.create', [
                'emps' => $students,
                'attendances' => $attendances,
                'selectedDate' => $date
            ]);
        } elseif ($user->role === 'teacher') {
            return view('teachers.attendances.create', [
                'emps' => $students,
                'attendances' => $attendances,
                'selectedDate' => $date
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $emp=Student::findOrfail($id);
        return view('students.details',compact('emp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $emp=Student::findOrfail($id);
        
        return view('students.edit',compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'eng_name'=>'required|max:25|alpha',
            'kh_name'=>'required|max:25|alpha',
            'gender'=>'required|max:10'
        ]);
        $data=$request->except("_token","_method");
        $employee=Student::where('id',$id)->update($data);
        if($employee) return to_route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emp=Student::findOrfail($id);
        if($emp->delete()){
            return to_route('students.index');
        }
    }
}
