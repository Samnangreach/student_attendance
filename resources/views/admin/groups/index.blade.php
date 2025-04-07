@extends('admin.layouts.masters')
@section('title','Group List')
@section('main')
    <div class="card">
        <div class="card-header">
            <a href="{{route('groups.create')}}" class="btn btn-sm btn-outline-primary">Add New</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hovered">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Group Name</th>
                        <th>Student Names</th>
                        <th>Class</th>
                        <th>Description</th>
                        {{-- <th>Create</th> --}}
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($groups as $group)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $group->group_name}}</td>
                                <td>
                                    @if ($group->students->isNotEmpty())
                                        {{ $group->students->pluck('eng_name')->implode(', ') }}
                                    @else
                                        No subjects assigned
                                    @endif
                                </td>
                                <td>{{ $group->class->class_name}}</td>
                                <td>{{ $group->description}}</td>
                                {{-- <td>{{ $group->created_at->format('d-m-Y') }}</td> --}}
                                <td >
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('groups.edit',['group'=>$group->id]) }}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit' title="Edit"></i></a>
                                        <form method="POST" action="{{route('groups.destroy',['group'=>$group->id])}}">
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