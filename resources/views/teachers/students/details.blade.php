@extends('teachers.layouts.masters')
@section('title','Students')
@section('main')
    <form action="{{ route('students.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <strong>Student</strong>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-2">#</dt>
                    <dd class="col-sm-10">{{ $emp->id }}</dd>
                    <dt class="col-sm-2">English Name</dt>
                    <dd class="col-sm-10">{{ $emp->eng_name }}</dd>
                    <dt class="col-sm-2">Khmer Name</dt>
                    <dd class="col-sm-10">{{ $emp->kh_name }}</dd>
                    <dt class="col-sm-2">Gender</dt>
                    <dd class="col-sm-10">{{ $emp->gender}}</dd>
                    <dt class="col-sm-2">Phone</dt>
                    <dd class="col-sm-10">{{ $emp->phone }}</dd>
                    <dt class="col-sm-2">Address</dt>
                    <dd class="col-sm-10">{{ $emp->address }}</dd>
                </dl>
                <a class="btn btn-sm btn-outline-success" href="{{ route('students.edit',['student'=>$emp->id]) }}">Edit stuloyee</a>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('students.index') }}">Back</a>
            </div>
        </div>
    </form>
@endsection
