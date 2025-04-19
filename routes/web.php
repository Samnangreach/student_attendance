<?php
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resources([
//     "student"=>StudentController::class,
// ]);



Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/hotel', [PageController::class, 'privacy'])->name('privacy');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact');
Route::get('/Login', [PageController::class, 'Login'])->name('Login');


Route::controller(AccountController::class)->group(function(){
    // Route::get('/dashboard','dashboard')->name('dashboard');
     // Role-based protected routes
     Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AccountController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/student', [AccountController::class, 'adminStudent'])->name('admin.student');
        Route::get('/admin/teacher', [AccountController::class, 'adminTeacher'])->name('admin.teacher');
        Route::get('/admin/attendance', [AccountController::class, 'adminAttendance'])->name('admin.attendance');
        Route::get('/admin/subject', [AccountController::class, 'adminSubject'])->name('admin.subject');
        Route::get('/admin/class', [AccountController::class, 'adminClass'])->name('admin.class');
        Route::get('/admin/group', [AccountController::class, 'adminGroup'])->name('admin.group');
        Route::get('/admin/schedule', [AccountController::class, 'adminSchedule'])->name('admin.schedule');
    });

    Route::middleware('role:teacher')->group(function () {
        Route::get('/teacher/dashboard', [AccountController::class, 'teacherDashboard'])->name('teachers.dashboard');
        Route::get('/teacher/student', [AccountController::class, 'teacherStudent'])->name('teachers.student');
        Route::get('/teacher/attendance', [AccountController::class, 'teacherAttendance'])->name('teachers.attendance');
        Route::get('/teacher/evaluation', [AccountController::class, 'teacherEvaluation'])->name('teachers.evaluation');
        Route::get('/teacher/schedule', [AccountController::class, 'teacherSchedule'])->name('teachers.schedule');
        Route::get('/reports/class/{class_id}', [AccountController::class, 'teacherReport'])->name('teachers.classReport');
    });

    
    // Route::get('/student','student')->name('student');
    // Route::get('/attendance','attendance')->name('attendance');
    // Route::get('/teacher','teacher')->name('teacher');

    Route::post('/logout','logout')->name('logout');
    Route::prefix('accounts')->group(function(){
        Route::get("register",'create')->name('accounts.create');
        Route::post("register",'store')->name('accounts.store');
        Route::get("login",'login')->name('login');
        Route::post("login",'authenticate')->name('accounts.authenticate');
    });
});

// Admin and Teacher specific resources
// Route::middleware(['auth'])->group(function () {
//     // Admin resources (students, teachers, etc.)
//     Route::middleware('role:admin')->group(function () {
//         Route::resource('students', StudentController::class);
//         Route::resource('attendances', AttendanceController::class);
//         Route::resource('teachers', TeacherController::class);
//         Route::resource('subjects', SubjectController::class);
//         Route::resource('classes', ClassesController::class);
//     });

//     // Teacher resources (students, attendances)
//     Route::middleware('role:teacher')->group(function () {
//         Route::resource('students', StudentController::class);
//         Route::resource('attendances', AttendanceController::class);
//     });
// });


// Route::middleware('auth', 'role:admin')->group(function () {
//     Route::resources([
//         "students" => StudentController::class,
//         "attendances" => AttendanceController::class,
//         "teachers" => TeacherController::class,
//         "subjects" => SubjectController::class,
//         "classes" => ClassesController::class,
//     ]);
// });

// Route::middleware('auth', 'role:teacher')->group(function () {
//     Route::resources([
//         "students" => StudentController::class,
//         "attendances" => AttendanceController::class,
//     ]);
// });

    Route::resources([
        "students"=>StudentController::class,
    ]);
    Route::resources([
        "attendances"=>AttendanceController::class,
    ]);
    Route::resources([
        "teachers"=>TeacherController::class,
    ]);
    Route::resources([
        "subjects"=>SubjectController::class,
    ]);
    Route::resources([
        "classes"=>ClassesController::class,
    ]);

    Route::resources([
        "groups"=>GroupController::class,
    ]);

    Route::resources([
        "evaluations"=>EvaluationController::class,
    ]);

    Route::resources([
        "schedules"=>ScheduleController::class,
    ]);
    
    Route::resources([
        "reports"=>ReportController::class,
    ]);






// Route::controller(StudentController::class)->group(function(){
//     Route::get('/students', 'index')->name('students.index'); // Show student list
//     Route::get('/students/create', 'create')->name('students.create'); // Show create form
//     Route::post('/students', 'show')->name('students.show');
//     Route::post('/students', 'store')->name('students.store'); // Save new student
//     Route::get('/students/{student}/edit', 'edit')->name('students.edit'); // Show edit form
//     Route::put('/students/{student}', 'update')->name('students.update'); // Update student
//     Route::delete('/students/{student}', 'destroy')->name('students.destroy'); // Delete student
// });
