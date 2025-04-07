@extends('layouts.masters')
@section('title','Create New Account')
@push('styles')
    <style>
        #register{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 80px;
            /* height: 100vh;
            width: 100%; */
        }
    </style>
@endpush
@section('main')
    <div class="container" id="register">
        <div class="card" style="width: 50%;height:45%;">
            <form class="m-3" action="{{ route('accounts.store' ) }}" method="POST">
                <ul class="text-danger">
                    @if($errors->any())
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    @endif
                </ul>
                <div class="card-body">
                    @csrf
                        <div class="row mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Name" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-2">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-2">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-2">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" />
                            @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-success">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection