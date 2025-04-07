<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //
    public function create(){
        return view('auths.create');
    }

    public function store(Request $re){
        $validators=$this->validated($re->only([
            'name',
            'email',
            'password',
            'confirm_password'
        ]));
        if($validators->fails()){
            return back()->withErrors($validators);
        }
        $user=$re->only(['name','email','password']);
        $user=$this->createUser($user);
        if($user){
            $credentials = $re->only('email','password');
            Auth::attempt($credentials);
            $re->session()->regenerate();
            return redirect()->route('students.index');
        }
        return back()->with('message',"Unable to create new User");
    }

    public function login(){
        return view('auths.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string'
        ]);

        $loginInput = $credentials['login'];
        $loginField = 'email'; // Default login field
    
        
        if (filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)) {
            $loginField = 'email';
        } else {

            $user = User::where('name', $loginInput)->first();

            if (!$user) {
                // If not a username, check if it is a teacher name in the teachers table
                $teacher = Teacher::where('teacher_name', $loginInput)->first();
                if ($teacher) {
                    // Find the associated user based on the teacher's email
                    $user = User::where('email', $teacher->email)->first();
                }
            }

            if (!$user) {
                return back()->withErrors(['login' => 'Invalid email, username, or teacher name.'])->onlyInput('login');
            }
            

            // $teacher = Teacher::where('teacher_name', $credentials['login'])->first();



            // if (!$teacher) {
            //     return back()->withErrors(['login' => 'Invalid email or teacher name.'])->onlyInput('login');
            // }

            // // Find the associated user based on the teacher's email
            // $user = User::where('email', $teacher->email)->first();

            // if (!$user) {
            //     return back()->withErrors(['login' => 'No associated user found for this teacher.'])->onlyInput('login');
            // }

            // Use the found user's email for authentication
            $credentials['login'] = $user->email;
            $loginField = 'email';
        }

        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $request->session()->regenerate();
    
            // Check the role entered by the user
            $user = Auth::user();
            if ($user->role !== $credentials['role']) {
                Auth::logout();
                return back()->withErrors(['role' => 'Role does not match our records.'])->onlyInput('role');
            }
    
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->withSuccess('Welcome, Admin!');
            } elseif ($user->role === 'teacher') {
                return redirect()->route('teachers.dashboard')->withSuccess('Welcome, Teacher!');
            }else{
                return redirect()->route('login')->with('error', 'Login failed! Invalid credentials or role mismatch.');
            }
    
            
        }

        return back()->withErrors([
            'login' => 'The password you entered is incorrect.',
        ])->onlyInput('login');
    }

   

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login')->withSuccess('You have Logged out successfully!');
    }

    public function validated(array $data){
        return Validator::make($data,[
            'name'=>'required|unique:users',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:4',
            'confirm_password'=>'required|min:4|same:password'
        ]);
    }

    public function createUser(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
    }

    public function adminDashboard(){
        if(Auth::check()){
            return view('admin.dashboard');
        }
        return redirect()->route('login')->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }

    public function adminStudent()
    {
        return redirect()->route('students.index'); 
    }

    public function adminAttendance()
    {
        return redirect()->route('attendances.index'); 
    }

    public function adminTeacher()
    {
        return redirect()->route('teachers.index'); 
    }

    public function adminSubject()
    {
        return redirect()->route('subjects.index'); 
    }

    public function adminClass()
    {
        return redirect()->route('classes.index');
    }

    public function adminGroup()
    {
        return redirect()->route('groups.index');
    }



    
    public function teacherDashboard(){
        if(Auth::check()){
            return view('teachers.dashboard');
        }
        return redirect()->route('login')->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }

    public function teacherStudent()
    {
        return redirect()->route('students.index'); // Redirect to StudentController
    }

    public function teacherAttendance()
    {
        return redirect()->route('attendances.index'); // Redirect to AttendanceController
    }
    
}
