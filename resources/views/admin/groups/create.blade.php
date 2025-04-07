@extends('admin.layouts.masters')
@section('title','Create Group')
@section('main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <form action="{{route('groups.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <strong>Create New Group</strong>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Group Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="group_name" class="form-control">
                        @error('group_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label  class="col-sm-2 form-col-label" for="">Select Students:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="students" name="students[]" multiple>
                            {{-- <option value="all">Select All</option> --}}
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->eng_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Class Name</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="classes" name="class_id">
                            {{-- <option value="all">Select All</option> --}}
                            <option value="" disabled selected>Select a Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        @error('class_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" name="description" class="form-control">
                        @error('description')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Save Changed</button>
                <a href="{{ route('groups.index')}}" class="btn btn-sm btn-outline-success">Back</a>
            </div>
        </div>
    </form>

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
        var select = new TomSelect("#students", {
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