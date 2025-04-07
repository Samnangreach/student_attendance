@extends('teachers.layouts.masters')
@section('title','Attendance')
@section('main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
.attendance-container {
    width: 100%;
    overflow-x: auto; /* Enables horizontal scrolling */
    position: relative;
}

.attendance-table {
    border-collapse: collapse;
    width: 100%;
    min-width: 1200px; /* Adjust if needed */
}


th, td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: center;
    white-space: nowrap;
}

/* Make the first five columns sticky */
.sticky-column {
    position: sticky;
    left: 0;
    background: white;
    z-index: 2;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}



/* Adjust the left position for each sticky column */
.sticky-column:nth-child(1) { left: 0; min-width: 50px; } /* No. Column */
.sticky-column:nth-child(2) { left: 50px; min-width: 150px; } /* English Name */
.sticky-column:nth-child(3) { left: 200px; min-width: 150px; } /* Khmer Name */
.sticky-column:nth-child(4) { left: 350px; min-width: 100px; } /* API ID */
.sticky-column:nth-child(5) { left: 450px; min-width: 100px; } /* Gender */

/* Scrollable columns */
.scrollable-column {
    /* min-width: 100px; */
    style="min-width: 40px; 
    max-width: 40px;
}


</style>

<div class="card">
    <div class="card-header">
        <a href="{{route('attendances.create')}}" class="btn btn-primary mb-2">Take Attendance</a>
        <span id="liveClock" style="float: right; text-align: right;"></span>

    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('attendances.store') }}">
            @csrf
            {{-- <button type="submit" class="btn btn-primary mb-3">Submit</button> --}}
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="sticky-column">No.</th>
                            <th class="sticky-column">English Name</th>
                            <th class="sticky-column">Khmer Name</th>
                            <th class="sticky-column">Gender</th>
                            <th class="sticky-column">API ID</th>
                            
                            @for ($i = 1; $i <= now()->daysInMonth; $i++)
                                <th class="scrollable-column" >
                                    {{-- {{ now()->format('d') }}-{{ str_pad($i, 2, '0', STR_PAD_LEFT) }} --}}
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emps as $index => $student)
                            <tr>
                                <td class="sticky-column">{{ $index + 1 }}</td>
                                <td class="sticky-column">{{ $student->eng_name }}</td>
                                <td class="sticky-column">{{ $student->kh_name }}</td>
                                <td class="sticky-column">{{ $student->gender }}</td>
                                <td class="sticky-column">API{{ str_pad($student->id, 3, '0', STR_PAD_LEFT) }}</td>

                                {{-- <td class="sticky-column">{{ $student->id }}</td> --}}
                            
                                @for ($i = 1; $i <= now()->daysInMonth; $i++)
                                    @php
                                        $date = now()->format('Y-m') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                                        $attendance = $student->attendances->where('date', $date)->first();
                                        $status = optional($attendance)->status;
                                        $note = optional($attendance)->note ?? 'No note';

                                        $statusText = match (strtolower($status)) {
                                            'present' => 'P',
                                            'absent' => 'A',
                                            'late' => 'L',
                                            'excused' => 'E',
                                            default => '-'
                                        };

                                    @endphp
                                    {{-- <td class="scrollable-column">{{ $statusText }}</td> --}}
                                    <td>
                                        <span data-bs-toggle="tooltip" title="{{ $note }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>


{{-- real time --}}
<script>
    function updateClock() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            month: 'long', 
            day: 'numeric', 
            year: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit', 
            hour12: true 
        };
        document.getElementById("liveClock").innerText = now.toLocaleString('en-GB', options);
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection