@extends('teachers.layouts.masters')
@section('title','Take Evaluation')
@section('main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="card">
    <div class="card-header">
        <h2>Student Evaluation</h2>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('evaluations.create') }}" id="filterForm" class="mb-4">
            <div class="row g-3">
                <div class="col-md-2">
                    <label for="class_id" class="form-label">Class</label>
                    <select name="class_id" id="class_id" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $subjectId == $subject->id ? 'selected' : '' }}>
                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="date" class="form-label">Date</label>
                    <input 
                        type="date" 
                        name="date" 
                        id="date" 
                        class="form-control" 
                        value="{{ request('date', now()->format('Y-m-d')) }}" 
                        onchange="document.getElementById('filterForm').submit()">
                </div>
                

                {{-- <div class="col-md-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $date }}" onchange="document.getElementById('filterForm').submit()">
                </div> --}}

                <div class="col-md-2">
                    <label for="term" class="form-label">Term</label>
                    <select name="term" id="term" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        @for ($i = 1; $i <= 4; $i++)
                            <option value="Term {{ $i }}" {{ $term == 'Term '.$i ? 'selected' : '' }}>
                                Term {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="week" class="form-label">Week</label>
                    <select name="week" id="week" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ (int)$week === $i ? 'selected' : '' }}>
                                W{{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>

        {{-- Evaluation Form --}}
        <form action="{{ route('evaluations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="class_id" value="{{ $classId }}">
            <input type="hidden" name="subject_id" value="{{ $subjectId }}">
            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="term" value="{{ $term }}">
            <input type="hidden" name="week" value="{{ $week }}">

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Classwork</th>
                        <th>Homework</th>
                        <th>Behavior</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $index => $student)
                        @php
                            $eval = $existing->get((int) $student->id);
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->eng_name ?? $student->name }}</td>
                            <input type="hidden" name="students[{{ $index }}][student_id]" value="{{ $student->id }}">
                
                            {{-- Classwork --}}
                            <td>
                                <select name="students[{{ $index }}][classwork]" class="form-select score-select" onchange="updateScoreColor(this)">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($eval && $eval->classwork == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                
                            {{-- Homework --}}
                            <td>
                                <select name="students[{{ $index }}][homework]" class="form-select score-select" onchange="updateScoreColor(this)">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($eval && $eval->homework == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                
                            {{-- Behavior --}}
                            <td>
                                <select name="students[{{ $index }}][behavior]" class="form-select score-select" onchange="updateScoreColor(this)">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($eval && $eval->behavior == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                
                            {{-- Note --}}
                            <td>
                                <input type="text" name="students[{{ $index }}][note]" class="form-control" value="{{ $eval->note ?? '' }}">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No students available</td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>

            <div class="card-footer mt-3">
                <button type="submit" class="btn btn-primary">Save Evaluation</button>
                <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateScoreColor(selectElement) {
        const value = parseInt(selectElement.value);
        selectElement.classList.remove('text-bg-success', 'text-bg-warning', 'text-bg-danger');

        if (value <= 3) {
            selectElement.classList.add('text-bg-danger');
        } else if (value <= 7) {
            selectElement.classList.add('text-bg-warning');
        } else {
            selectElement.classList.add('text-bg-success');
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.score-select').forEach(updateScoreColor);
    });
</script>

@endsection
