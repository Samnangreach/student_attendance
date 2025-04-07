@extends('admin.layouts.masters')
@section('title','New Teacher')
@section('main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <form action="{{route('teachers.store')}}" method="POST" autocomplete="off">
        @csrf
        <div class="card">
            <div class="card-header">
                <strong>Create New Student</strong>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Teacher Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="teacher_name" class="form-control">
                        @error('teacher_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label" >email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" >
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Password</label>
                    <div class="col-sm-10">
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
                    <label class="col-sm-2 form-col-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-select">
                            <option value="" style="display:none;">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- <div class="row mb-2">
                    <label for="subjects" class="col-sm-2 form-col-label">Select Subjects</label>
                    <div class="col-sm-10">
                        <select multiple class="form-control" id="subjects" name="subjects[]" required>
                            @foreach($subs as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>       --}}
                <div class="row mb-2">
                    <label  class="col-sm-2 form-col-label" for="">Select Subjects:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="subject" name="subjects[]" multiple>
                            {{-- <option value="all">Select All</option> --}}
                            @foreach($subs as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <label  class="col-sm-2 form-col-label" for="">Select Class:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="class" name="classes[]" multiple>
                            {{-- <option value="all">Select All</option> --}}
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="tel" name="phone" class="form-control">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Commune and Village" name="address" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Save Changed</button>
                <a href="{{ route('teachers.index')}}" class="btn btn-sm btn-outline-success">Back</a>
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
        var select = new TomSelect("#subject", {
            plugins: ['remove_button'],
            maxItems: null,
            hideSelected: true,
            persist: false,
            create: false,
            render: {
                option: function(data, escape) {
                    return '<div>' + escape(data.text) + '</div>';
                }
            }
        });

        // Handle "Select All" functionality
        select.on('change', function() {
            let selectedValues = select.getValue();
            if (selectedValues.includes("all")) {
                select.setValue(
                    Array.from(document.querySelectorAll("#subjects option")).map(opt => opt.value)
                );
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var select = new TomSelect("#class", {
            plugins: ['remove_button'],
            maxItems: null,
            hideSelected: true,
            persist: false,
            create: false,
            render: {
                option: function(data, escape) {
                    return '<div>' + escape(data.text) + '</div>';
                }
            }
        });

        // Handle "Select All" functionality
        select.on('change', function() {
            let selectedValues = select.getValue();
            if (selectedValues.includes("all")) {
                select.setValue(
                    Array.from(document.querySelectorAll("#subjects option")).map(opt => opt.value)
                );
            }
        });
    });
</script>

@endsection