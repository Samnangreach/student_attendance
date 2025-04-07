@extends('admin.layouts.masters')
@section('title','Edit Group')
@section('main')

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<form action="{{ route('groups.update', $group->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header">
            <strong>Edit Group</strong>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <label class="col-sm-2 form-col-label">Group Name</label>
                <div class="col-sm-10">
                    <input type="text" name="group_name" class="form-control" value="{{ old('group_name', $group->group_name) }}">
                    @error('group_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-2">
                <label class="col-sm-2 form-col-label">Select Students:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="students" name="students[]" multiple>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" 
                                {{ in_array($student->id, $group->students->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $student->eng_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-2">
                <label class="col-sm-2 form-col-label">Class Name</label>
                <div class="col-sm-10">
                    <select class="form-control" id="classes" name="class_id">
                        <option value="" disabled>Select a Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $group->class_id == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
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
                    <input type="text" name="description" class="form-control" value="{{ old('description', $group->description) }}">
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <button class="btn btn-sm btn-success">Update Group</button>
            <a href="{{ route('groups.index') }}" class="btn btn-sm btn-outline-success">Back</a>
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
        new TomSelect("#students", {
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
    });
</script>

@endsection
