@extends('admin.layouts.masters')
@section('title', 'Create Schedule')
@section('main')
<form action="{{ route('schedules.store') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header"><strong>Create New Schedule</strong></div>
        <div class="card-body">
            <div class="mb-3">
                <label>Teacher</label>
                <select name="teacher_id" class="form-control" required>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Class</label>
                <select name="class_id" class="form-control" required>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Subject</label>
                <select name="subject_id" class="form-control" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Teaching Days</label>
                <select id="days" name="days[]" class="form-control" multiple required>
                    {{-- Special "Everyday" option --}}
                    <option value="everyday">Everyday</option>
            
                    {{-- Standard weekday options --}}
                    @foreach(['monday','tuesday','wednesday','thursday','friday','saturday','sunday'] as $day)
                        <option value="{{ $day }}"
                            {{ isset($schedule) && in_array($day, $schedule->days ?? []) ? 'selected' : '' }}>
                            {{ ucfirst($day) }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Hold Ctrl/Cmd to select multiple. Choose "Everyday" to select all days.</small>
            </div>
            
            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Start Time</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>End Time</label>
                <input type="time" name="end_time" class="form-control" required>
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</form>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const daysSelect = document.getElementById('days');

        daysSelect.addEventListener('change', function () {
            const selected = [...this.selectedOptions].map(opt => opt.value);

            if (selected.includes('everyday')) {
                // Select all weekdays
                const allDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                for (let option of this.options) {
                    option.selected = allDays.includes(option.value);
                }
            }
        });
    });
</script> --}}

<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

    <style>
        .ts-wrapper.multi .ts-control {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const allDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        const select = new TomSelect("#days", {
            plugins: ['remove_button'],
            maxItems: null,
            hideSelected: true,
            persist: false,
            create: false,
            render: {
                option: function (data, escape) {
                    return '<div>' + escape(data.text) + '</div>';
                }
            },
            onChange: function (selectedValues) {
                if (selectedValues.includes("everyday")) {
                    // Automatically select all weekdays (remove "everyday" from final values)
                    this.setValue(allDays, true); // true = silent (no re-trigger)
                }
            }
        });
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


@endsection
