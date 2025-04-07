@extends('teachers.layouts.masters')
@section('title','Students')
@section('main')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('students.update',['student'=>$emp->id])}}" method="POST">
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
                            <option value="male" {{ $emp->gender=='male'?'selected':'' }}>Male</option>
                            <option value="female" {{ $emp->gender=='female'?'selected':'' }}>Female</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="classes[]" value="{{ $selectedClassId }}">

                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Class</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                            value="{{ \App\Models\Classes::find($selectedClassId)->class_name }}" disabled>
                    </div>
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
                        <input type="text" value="{{ $emp->address }}" placeholder="Commune and Village" name="address" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Save Changed</button>
                <a href="{{ route('students.index')}}" class="btn btn-sm btn-outline-success">Back</a>
            </div>
        </div>
    </form>
@endsection
               