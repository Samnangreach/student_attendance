@extends('admin.layouts.masters')
@section('title','Edit Teacher')
@section('main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <form action="{{ route('teachers.update', $tea->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <strong>Edit Teacher</strong>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Teacher Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="teacher_name" class="form-control" value="{{ old('teacher_name', $tea->teacher_name) }}">
                        @error('teacher_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" value="{{ old('email', $tea->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">New Password</label>
                    <div class="col-sm-10 position-relative">
                        <input type="password" id="password" name="password" class="form-control">
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword()">
                            <i id="toggleIcon" class="fa fa-eye"></i>
                        </span>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="toggleConfPassword()">
                            <i id="toggleConfIcon" class="fa fa-eye"></i>
                        </span>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-select">
                            <option value="" style="display:none;">Select gender</option>
                            <option value="male" {{ old('gender', $tea->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $tea->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="subjects"  class="col-sm-2 form-col-label">Select Subjects:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="subjects" name="subjects[]" multiple required>
                            @foreach($subs as $subject)
                                <option value="{{ $subject->id }}" 
                                    {{ $tea->subjects->contains($subject->id) ? 'selected' : '' }}>
                                    {{ $subject->subject_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="classes" class="col-sm-2 form-col-label">Assign Classes</label>
                    <div class="col-sm-10">
                        <select name="classes[]" id="classes" class="form-control" multiple>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ $tea->classes->contains($class->id) ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone', $tea->phone) }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" class="form-control" value="{{ old('address', $tea->address) }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary">Update Teacher</button>
                <a href="{{ route('teachers.index')}}" class="btn btn-sm btn-outline-secondary">Back</a>
            </div>
        </div>
    </form>

    <script>
        function togglePassword() {
            let passwordInput = document.getElementById("password");
            let toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }

        function toggleConfPassword() {
            let passwordInput = document.getElementById("password_confirmation");
            let toggleIcon = document.getElementById("toggleConfIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>

<!-- Tom Select CSS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

<style>
    .ts-wrapper.multi .ts-control {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
        // Initialize Tom Select
        var select = new TomSelect("#subjects", {
            plugins: ['remove_button'], // Enables the 'x' button for removal
            maxItems: null,             // Allow multiple selections
            hideSelected: true,         // Hide already selected options
            persist: false,             // Do not persist options
            create: false,              // Prevent creating new options
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Tom Select
        var select = new TomSelect("#classes", {
            plugins: ['remove_button'], // Enables the 'x' button for removal
            maxItems: null,             // Allow multiple selections
            hideSelected: true,         // Hide already selected options
            persist: false,             // Do not persist options
            create: false,              // Prevent creating new options
        });
    });
</script>

@endsection
