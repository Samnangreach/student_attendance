@extends('layouts.masters')
<div class="container">
    <form method="POST" action="{{ route('attendances.store') }}">
        @csrf
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        @for ($i = 1; $i <= now()->daysInMonth; $i++)
                            <th>{{ now()->format('Y-m') }}-{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emps as $student)
                        <tr>
                            <td>{{ $student->eng_name }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->address }}</td>
                            @for ($i = 1; $i <= now()->daysInMonth; $i++)
                                @php
                                    $date = now()->format('Y-m') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                                    $attendance = $student->attendances->where('date', $date)->first();
                                    $status = $attendance->status ?? '';
                                @endphp
                                <td>
                                    <select name="attendance[{{ $student->id }}][{{ $date }}]">
                                        <option value="P" {{ $status == 'P' ? 'selected' : '' }}>P</option>
                                        <option value="L" {{ $status == 'L' ? 'selected' : '' }}>L</option>
                                        <option value="A" {{ $status == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="E" {{ $status == 'E' ? 'selected' : '' }}>E</option>
                                    </select>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>