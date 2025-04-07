@extends('teachers.layouts.masters')
@section('title','Students')
@section('main')
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


            {{-- Hidden class assignment --}}
            <input type="hidden" name="classes[]" value="{{ old('classes.0', $selectedClass->id) }}">
{{-- show class info --}}


            <div class="card-footer">
                <button class="btn btn-sm btn-success">Save Changed</button>
                <a href="{{ route('students.index')}}" class="btn btn-sm btn-outline-success">Back</a>
            </div>
        </div>
    </form>
@endsection