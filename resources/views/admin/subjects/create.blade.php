@extends('admin.layouts.masters')
@section('title','Subjects')
@section('main')
    <form action="{{route('subjects.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <strong>Create New Subject</strong>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Subject Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="subject_name" class="form-control">
                        @error('subject_name')
                            <span class="text-danger">{{$message}}</span>
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
                <a href="{{ route('subjects.index')}}" class="btn btn-sm btn-outline-success">Back</a>
            </div>
        </div>
    </form>
@endsection