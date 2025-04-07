@extends('admin.layouts.masters')
@section('title','Classes')
@section('main')
    <form action="{{ route('classes.update',['class'=>$class->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <strong>Edit Class</strong>
            </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <label class="col-sm-2 form-col-label">Class Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ $class->class_name }}" name="class_name" class="form-control">
                            @error('class_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                    <label class="col-sm-2 form-col-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $class->description }}" name="description" class="form-control">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Save Changed</button>
                <a href="{{ route('classes.index')}}" class="btn btn-sm btn-outline-success">Back</a>
            </div>
        </div>
    </form>
@endsection
               