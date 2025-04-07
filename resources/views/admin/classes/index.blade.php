@extends('admin.layouts.masters')
@section('title','Class List')
@section('main')
    <div class="card">
        <div class="card-header">
            <a href="{{route('classes.create')}}" class="btn btn-sm btn-outline-primary">Add New</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hovered">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Class Name</th>
                        <th>Description</th>
                        <th>Create</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($classes as $class)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $class->class_name}}</td>
                                <td>{{ $class->description}}</td>
                                <td>{{ $class->created_at->format('d-m-Y') }}</td>
                                <td >
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('classes.edit',['class'=>$class->id]) }}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit' title="Edit"></i></a>
                                        <form method="POST" action="{{route('classes.destroy',['class'=>$class->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat" onclick="return confirm()"><i class='fa fa-trash' title="Delete"></i></button>
                                            {{-- <a href="{{route('students.show',['student'=>$class->id]) }}" class="btn btn-sm btn-outline-secondary">Show</a> --}}
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