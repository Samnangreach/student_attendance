@extends('teachers.layouts.masters')
@section('title','Edit Evaluation')
@section('main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="card">
    <div class="card-header">
        <h2>Edit Student Evaluation</h2>
    </div>
    <div class="card-body">

        <form action="{{ route('evaluations.update', $date) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="class_id" value="{{ $classId }}">
            <input type="hidden" name="subject_id" value="{{ $subjectId }}">

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Class</label>
                    <input type="text" class="form-control" value="{{ $class->class_name ?? 'Unknown Class' }}" readonly>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" value="{{ $subject->subject_name ?? 'Unknown Subject' }}" readonly>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" value="{{ $date }}" readonly>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Term</label>
                    <input type="text" name="term" class="form-control" value="{{ $term }}" readonly>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Week</label>
                    <input type="text" name="week" class="form-control" value="{{ $week }}" readonly>
                </div>
            </div>

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
                            // $eval = $evaluations->get((int) $student->id);
                            $eval = $evaluations->get($student->id);
                            $classwork = $eval->Classwork ?? 0;
                            $homework = $eval->Homework ?? 0;
                            $behavior = $eval->Behavior ?? 0;
                            $note = $eval->Note ?? '';
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->eng_name ?? $student->name }}</td>
                            <input type="hidden" name="students[{{ $index }}][student_id]" value="{{ $student->id }}">

                            <td>
                                <select name="students[{{ $index }}][Classwork]" class="form-select score-select" onchange="updateScoreColor(this)">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ (int)$classwork === $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>

                            <td>
                                <select name="students[{{ $index }}][Homework]" class="form-select score-select" onchange="updateScoreColor(this)">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ (int)$homework === $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>

                            <td>
                                <select name="students[{{ $index }}][Behavior]" class="form-select score-select" onchange="updateScoreColor(this)">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ (int)$behavior === $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>

                            <td>
                                <input type="text" name="students[{{ $index }}][Note]" class="form-control" value="{{ $eval->Note ?? '' }}">
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No students available</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="card-footer mt-3">
                <button type="submit" class="btn btn-primary">Update Evaluation</button>
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
