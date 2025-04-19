@extends('teachers.layouts.masters')
@section('title', 'Student Report')
@section('main')
<div class="container">
    {{-- Filter Form --}}
    <form method="GET" action="{{ route('reports.index') }}" class="mb-4">
        <div class="row">
            <div class="col">
                <label>Select Class</label>
                <select name="class_id" class="form-control" required>
                    <option value="">-- Choose Class --</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ request('class_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->class_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Term</label>
                <select name="term" class="form-control">
                    <option value="">All</option>
                    @foreach(range(1, 3) as $t)
                        <option value="{{ $t }}" {{ request('term') == $t ? 'selected' : '' }}>Term {{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Week</label>
                <select name="week" class="form-control">
                    <option value="">All</option>
                    @foreach(range(1, 10) as $w)
                        <option value="{{ $w }}" {{ request('week') == $w ? 'selected' : '' }}>Week {{ $w }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col d-flex align-items-end">
                <button class="btn btn-primary">Generate</button>
            </div>
        </div>
    </form>

    {{-- Report Section --}}
    @if($class)
        <h4>Report for Class: {{ $class->class_name }}</h4>

        @foreach($class->students as $student)
            <div class="card mb-3">
                <div class="card-header">{{ $student->student_name }}</div>
                <div class="card-body">
                    {{-- Attendance Summary --}}
                    @php
                        $present = $student->attendances->where('Status', 'P')->count();
                        $absent = $student->attendances->where('Status', 'A')->count();
                        $late = $student->attendances->where('Status', 'L')->count();
                        $excused = $student->attendances->where('Status', 'E')->count();
                    @endphp
                    <p>Present: {{ $present }}, Absent: {{ $absent }}, Late: {{ $late }}, Excused: {{ $excused }}</p>

                    {{-- Evaluations --}}
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
                            @foreach($student->evaluations as $eval)
                                <tr>
                                    <td>{{ $eval->subject->subject_name ?? 'N/A' }}</td>
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
    @elseif(request()->has('class_id'))
        <div class="alert alert-warning">No data found for selected filters.</div>
    @endif
</div>
@endsection
