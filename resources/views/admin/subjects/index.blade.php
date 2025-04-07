@extends('admin.layouts.masters')
@section('title','Subject List')
@section('main')
    <div class="card">
        <div class="card-header">
            <a href="{{route('subjects.create')}}" class="btn btn-sm btn-outline-primary">Add New</a>
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
                        <th>Subject Name</th>
                        <th>Description</th>
                        <th>Create</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($subs as $sub)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $sub->subject_name}}</td>
                                <td>{{ $sub->description}}</td>
                                <td>{{ $sub->created_at->format('d-m-Y') }}</td>
                                <td >
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('subjects.edit',['subject'=>$sub->id]) }}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit' title="Edit"></i></a>
                                        <form method="POST" action="{{route('subjects.destroy',['subject'=>$sub->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat" onclick="return confirm()"><i class='fa fa-trash' title="Delete"></i></button>
                                            {{-- <a href="{{route('students.show',['student'=>$sub->id]) }}" class="btn btn-sm btn-outline-secondary">Show</a> --}}
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