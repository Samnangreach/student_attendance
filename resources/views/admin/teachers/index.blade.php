@extends('admin.layouts.masters')
@section('title','Teacher List')
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
        <div class="card-header">
            <a href="{{route('teachers.create')}}" class="btn btn-sm btn-outline-primary">Add New</a>
            <div class="dt-buttons btn-group">
                <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="datable-buttons" type="button">Copy</button>
                <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datable-buttons" type="button">Excel</button>
                <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="datable-buttons" type="button">PDF</button>
                <button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="datable-buttons" type="button" aria-haspopup="true">...</button>
            </div>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hovered">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Teacher Name</th>
                        <th>Gender</th>
                        <th>Subject</th>
                        <th>Class</th>
                        {{-- <th>Email</th> --}}
                        <th>Phone</th>
                        {{-- <th>Address</th> --}}
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($teas as $tea)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $tea->teacher_name}}</td>
                                <td>{{ $tea->gender}}</td>
                                <td>
                                    @if ($tea->subjects->isNotEmpty())
                                        {{ $tea->subjects->pluck('subject_name')->implode(', ') }}
                                    @else
                                        No subjects assigned
                                    @endif
                                </td>
                                <td>
                                    @if ($tea->classes->isNotEmpty())
                                        {{ $tea->classes->pluck('class_name')->implode(', ') }}
                                    @else
                                        No classes assigned
                                    @endif
                                </td>
                                {{-- <td>{{ $tea->email}}</td> --}}
                                <td>{{ $tea->phone}}</td>
                                {{-- <td>{{ $tea->address}}</td> --}}
                                <td >
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('teachers.edit',['teacher'=>$tea->id]) }}" class="btn btn-success btn-sm edit btn-flat" title="Edit"><i class='fa fa-edit'></i></a>
                                        <a href="{{route('teachers.show',['teacher'=>$tea->id]) }}" class="btn btn-success btn-sm view btn-flat" title="View"><i class='fa fa-eye'></i></a>
                                        <form method="POST" action="{{route('teachers.destroy',['teacher'=>$tea->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat" onclick="return confirm()" title="Delete"><i class='fa fa-trash' ></i></button>
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