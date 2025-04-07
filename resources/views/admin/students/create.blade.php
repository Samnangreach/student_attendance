@extends('admin.layouts.masters')
@section('title','Students')
@section('main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <form action="{{route('students.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <strong>Create New Student</strong>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">English Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="eng_name" class="form-control">
                        @error('eng_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Khmer Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="kh_name" class="form-control">
                        @error('kh_name')
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
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label" for="subjects">Select Class:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="classes" name="classes[]" multiple>
                            {{-- <option value="all">Select All</option> --}}
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Parent Phone</label>
                    <div class="col-sm-10">
                        <input type="tel" name="phone" class="form-control">
                    </div>
                </div>
                {{-- <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Date of Birth</label>
                    <div class="col-sm-10">
                        <input type="date" name="dob" class="form-control">
                    </div>
                </div> --}}
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Commune and Village" name="address" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Save Changed</button>
                <a href="{{ route('students.index')}}" class="btn btn-sm btn-outline-success">Back</a>
            </div>
        </div>
    </form>

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
        var select = new TomSelect("#classes", {
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
                    Array.from(document.querySelectorAll("#classes option")).map(opt => opt.value)
                );
            }
        });
    });
</script>
@endsection