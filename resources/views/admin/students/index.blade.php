@extends('admin.layouts.masters')
@section('title','Student List')
@section('main')
{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('students.index')}}">Students</a>
          </li>
        </ul>
        <form action="/students" action="{{ route('students.index') }}" method="GET" class="d-flex" role="search">
            @csrf
          <input class="form-control me-2" type="text" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
</nav> --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{route('students.create')}}" class="btn btn-sm btn-outline-primary">Add New</a>
            {{-- <div class="dt-buttons btn-group">
                <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="datable-buttons" type="button">Copy</button>
                <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datable-buttons" type="button">Excel</button>
                <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="datable-buttons" type="button">PDF</button>
                <button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="datable-buttons" type="button" aria-haspopup="true">...</button>
            </div> --}}
            <form method="GET" action="{{ route('students.index') }}" class="mb-0 ms-3" style="max-width: 400px; margin: auto;">
                <div class="input-group">
                    <label class="input-group-text">Filter by Class:</label>
                    <select name="class_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- All Classes --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hovered">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Eng Name</th>
                        <th>Kh Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Parent Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($emps as $stu)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $stu->eng_name}}</td>
                                <td>{{ $stu->kh_name}}</td>
                                <td>{{ $stu->gender}}</td>
                                <td>
                                    @if ($stu->classes->isNotEmpty())
                                        {{ $stu->classes->pluck('class_name')->implode(', ') }}
                                    @else
                                        No classes assigned
                                    @endif
                                </td>
                                <td>{{ $stu->phone}}</td>
                                <td>{{ $stu->address}}</td>
                                <td >
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('students.edit',['student'=>$stu->id]) }}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit' title="Edit"></i></a>
                                        <form method="POST" action="{{route('students.destroy',['student'=>$stu->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat" onclick="return confirm()"><i class='fa fa-trash' title="Delete"></i></button>
                                            {{-- <a href="{{route('students.show',['student'=>$stu->id]) }}" class="btn btn-sm btn-outline-secondary">Show</a> --}}
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <h5>No Data</h5>
                                </td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection      