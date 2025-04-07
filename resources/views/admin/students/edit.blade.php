@extends('admin.layouts.masters')
@section('title', 'Students')
@section('main')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <form action="{{ route('students.update', ['student' => $emp->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <strong>Create New Student</strong>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">English Name</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $emp->eng_name }}" name="eng_name" class="form-control">
                        @error('eng_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Khmer Name</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $emp->kh_name }}" name="kh_name" class="form-control">
                        @error('kh_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-select">
                            <option value="" style="display:none;">Select Gender</option>
                            <option value="male" {{ $emp->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $emp->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="classes" class="form-label">Select Classes:</label>
                    <select class="form-control" id="classes" name="classes[]" multiple required>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}"
                                {{ optional($emp)->classes->contains($class->id) ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="tel" value="{{ $emp->phone }}" name="phone" class="form-control">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $emp->address }}" placeholder="Commune and Village" name="address"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Save Changed</button>
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-success">Back</a>
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
