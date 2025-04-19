@extends('admin.layouts.masters')
@section('title', 'Schedules')
@section('main')
<div class="card">
    <div class="card-header">
        <strong>All Schedules</strong>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary float-end">Add Schedule</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Teacher</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->date }}</td>
                        <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td>{{ $schedule->teacher->teacher_name }}</td>
                        <td>{{ $schedule->class->class_name }}</td>
                        <td>{{ $schedule->subject->subject_name }}</td>
                        <td>
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>                            
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
