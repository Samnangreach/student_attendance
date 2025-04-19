@extends('teachers.layouts.masters')
@section('title', 'My Schedule')
@section('main')
<div class="card">
    <div class="card-header"><strong>Today & Upcoming Schedules</strong></div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Class</th>
                    <th>Subject</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->date }}</td>
                        <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td>{{ $schedule->class->class_name }}</td>
                        <td>{{ $schedule->subject->subject_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
