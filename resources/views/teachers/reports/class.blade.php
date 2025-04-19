@extends('layouts.app')
@section('title', 'Class Report')

@section('content')
<div class="container">
    <h2>Report for Class: {{ $class->class_name }}</h2>

    @foreach ($class->students as $student)
        <div class="card my-4">
            <div class="card-header">
                <strong>{{ $student->student_name }}</strong> | Age: {{ $student->age }}
            </div>
            <div class="card-body">
                <h5>Attendance</h5>
                @php
                    $present = $student->attendances->where('Status', 'P')->count();
                    $absent = $student->attendances->where('Status', 'A')->count();
                    $late = $student->attendances->where('Status', 'L')->count();
                    $excused = $student->attendances->where('Status', 'E')->count();
                @endphp
                <ul>
                    <li>Present: {{ $present }}</li>
                    <li>Absent: {{ $absent }}</li>
                    <li>Late: {{ $late }}</li>
                    <li>Excused: {{ $excused }}</li>
                </ul>

                <h5>Evaluations</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Classwork</th>
                            <th>Homework</th>
                            <th>Note</th>
                            <th>Behavior</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->evaluations as $eval)
                        <tr>
                            <td>{{ $eval->subject->subject_name }}</td>
                            <td>{{ $eval->Classwork }}</td>
                            <td>{{ $eval->Homework }}</td>
                            <td>{{ $eval->Note }}</td>
                            <td>{{ $eval->Behavior }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection
