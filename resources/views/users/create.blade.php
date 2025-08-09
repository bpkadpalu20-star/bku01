
@extends('layouts.master')
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Create Data</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create User</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            <a href="{{ route('users.index') }}" class="btn btn-info btn-wave me-2 btn-b"><i class="mdi mdi-backup-restore"></i> Back</a>

        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
        </div>
    </div>
</div>
 <!-- Start:: row-1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
            </div>
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row gy-4">
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Name</label>
                            <input value="{{ old('name') }}" placeholder="Enter Name" name="name" type="text" class="form-control" >
                            @error('name')
                                <p class="text-red-400 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Email</label>
                            <input value="{{ old('email') }}" placeholder="Enter Email" name="email" type="text" class="form-control" >
                            @error('email')
                                <p class="text-red-400 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Password</label>
                            <input value="{{ old('password') }}" placeholder="Enter Password" name="password" type="password" class="form-control" >
                            @error('password')
                                <p class="text-red-400 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Confirm Password</label>
                            <input value="{{ old('confirm_password') }}" placeholder="Confirm your Password" name="confirm_password" type="password" class="form-control" >
                            @error('confirm_password')
                                <p class="text-red-400 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <div class="mt-3">
                                        <input  type="checkbox" class="form-check-input rounded" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}">
                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
