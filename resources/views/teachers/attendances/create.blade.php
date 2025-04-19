@extends('teachers.layouts.masters')
@section('title','Take Attendance')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="card">
        <div class="card-header">
        <h2>Record Attendance</h2>
        </div>
        <div class="card-body">
            <form id="dateForm" action="{{ route('attendances.create') }}" method="GET">
                <div class="mb-3">
                    <label for="date" class="form-label">Select Date</label>
                    {{-- <input type="date" name="date" id="date" class="form-control" style="width: 150px;" value="{{ $selectedDate }}"> --}}
                    {{-- <input type="date" name="date" id="date" class="form-control" style="width: 150px;" value="{{ $selectedDate ?? now()->toDateString() }}"> --}}
                    <input type="date" name="date" id="date" class="form-control" style="width: 150px;" value="{{ old('date', now()->format('y-m-d')) }}">
                    {{-- <button type="submit" class="btn btn-secondary mt-2">Load Attendance</button> --}}
                    
                </div>
            </form>
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            <input type="hidden" name="class_id" value="{{ $selectedClass->id }}">
            <!-- Attendance Date -->
            <input type="hidden" name="date" value="{{ $selectedDate }}">

            {{-- Hidden class assignment --}}
            {{-- ✅ Correct --}}
            {{-- <input type="hidden" name="class_id" value="{{ old('class_id', $selectedClass->id) }}"> --}}
           



            {{-- show class info --}}
            {{-- <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" style="width: 150px;" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div> --}}

            <!-- Attendance Records Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>English Name</th>
                        <th>Khmer Name</th>
                        <th>Gender</th>
                        <th>Present</th>
                        <th>Late</th>
                        <th>Absent</th>
                        <th>Excused</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($emps as $index => $student)
                        @php
                            $attendance = $attendances[$student->id] ?? null;
                            $status = optional($attendance)->status;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->eng_name }}</td>
                            <td>{{ $student->kh_name }}</td>
                            <td>{{ ucfirst($student->gender) }}</td>

                            <!-- Checkbox inputs for attendance -->
                            {{-- <td><input type="radio" name="attendance[{{ $student->id }}][status]" value="present" {{ $attendance && $attendance->status === 'present' ? 'checked' : '' }}></td>

                            <td><input type="radio" name="attendance[{{ $student->id }}][status]" value="late" {{ $attendance && $attendance->status === 'late' ? 'checked' : '' }}></td>

                            <td><input type="radio" name="attendance[{{ $student->id }}][status]" value="absent" {{ $attendance && $attendance->status === 'absent' ? 'checked' : '' }}></td>

                            <td><input type="radio" name="attendance[{{ $student->id }}][status]" value="excused" {{ $attendance && $attendance->status === 'excused' ? 'checked' : '' }}></td> --}}

                           
                            <td class="sticky-column">
                                    <input type="radio" name="attendance[{{ $student->id }}][status]" value="present" 
                                        {{ $status == 'present' ? 'checked' : '' }}> &nbsp;
                            </td>
                           
                            <td>
                                <input type="radio" name="attendance[{{ $student->id }}][status]" value="late" 
                                        {{ $status == 'late' ? 'checked' : '' }}> &nbsp;
                            </td>
                            <td>
                                <input type="radio" name="attendance[{{ $student->id }}][status]" value="absent" 
                                        {{ $status == 'absent' ? 'checked' : '' }}> &nbsp;
                            </td>
                            <td>
                                <input type="radio" name="attendance[{{ $student->id }}][status]" value="excused" 
                                {{ $status == 'excused' ? 'checked' : '' }}> 
                            </td>

                            <!-- Note input field -->
                            <td><input type="text" name="attendance[{{ $student->id }}][note]" class="form-control" value="{{ optional($attendance)->note }}" class="form-control"></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No students available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Attendance</button>
                <a href="{{ route('attendances.index')}}" class="btn btn-sm btn-outline-success">Back</a>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let dateInput = document.getElementById("date");

        // Set default date if empty
        if (!dateInput.value) {
            let today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        }

        // Auto-submit form when date changes
        dateInput.addEventListener('change', function() {
            document.getElementById('dateForm').submit();
        });
    });
</script>
@endsection