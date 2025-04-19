@extends('admin.layouts.masters')
@section('title', 'Edit Schedule')
@section('main')
<form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header"><strong>Edit Schedule</strong></div>
        <div class="card-body">

            <div class="mb-3">
                <label>Teacher</label>
                <select name="teacher_id" class="form-control" required>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $schedule->teacher_id ? 'selected' : '' }}>
                            {{ $teacher->teacher_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Class</label>
                <select name="class_id" class="form-control" required>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ $class->id == $schedule->class_id ? 'selected' : '' }}>
                            {{ $class->class_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Subject</label>
                <select name="subject_id" class="form-control" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $subject->id == $schedule->subject_id ? 'selected' : '' }}>
                            {{ $subject->subject_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="{{ $schedule->date }}" required>
            </div>

            <div class="mb-3">
                <label>Start Time</label>
                <input type="time" name="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
            </div>

            <div class="mb-3">
                <label>End Time</label>
                <input type="time" name="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </div>
</form>
@endsection
