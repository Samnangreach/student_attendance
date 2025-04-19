@extends('teachers.layouts.masters')
@section('title','Evaluations')
@section('main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <a href="{{ route('evaluations.create') }}" class="btn btn-primary mb-2">New Evaluation</a>
            <h3 class="text-primary mb-0">
                Students in Class: {{ $selectedClass->class_name }}
            </h3>
        </div>

        <form method="GET" class="mb-3 d-flex gap-3 align-items-end">
            <div>
                <label for="term" class="form-label">Term</label>
                <select name="term" id="term" class="form-select">
                    <option value="">All Terms</option>
                    @for ($i = 1; $i <= 4; $i++)
                        <option value="Term {{ $i }}" {{ request('term') == 'Term '.$i ? 'selected' : '' }}>
                            Term {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="week" class="form-label">Week</label>
                <select name="week" id="week" class="form-select">
                    <option value="">All Weeks</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('week') == $i ? 'selected' : '' }}>Week {{ $i }}</option>
                    @endfor
                </select>
            </div>
            
            {{-- <div>
                <label for="class_id" class="form-label">Class</label>
                <select name="class_id" id="class_id" class="form-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->class_name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}
            <div>
                <button type="submit" class="btn btn-outline-primary">Filter</button>
            </div>
        </form>
        

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        {{-- <th>Class</th> --}}
                        <th>Subject</th>
                        <th>Term</th>
                        <th>Week</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($evaluations as $eval)
                        <tr>
                            <td>{{ $eval->date }}</td>
                            {{-- <td>{{ $eval->class->class_name ?? 'N/A' }}</td> --}}
                            <td>{{ $eval->subject->subject_name ?? 'N/A' }}</td>
                            <td>{{ $eval->term ?? '-' }}</td>
                            <td>{{ $eval->week ?? '-' }}</td>
                            <td>
                                <a href="{{ route('evaluations.edit', $eval->date) }}?class_id={{ $eval->class_id }}&subject_id={{ $eval->subject_id }}" 
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No evaluations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
