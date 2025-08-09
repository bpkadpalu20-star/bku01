@extends('layouts.master')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Edit Data</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Roles</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            <a href="{{ route('roles.index') }}" class="btn btn-info btn-wave me-2 btn-b"><i class="mdi mdi-backup-restore"></i> Back</a>

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
            <form action="{{ route('roles.update',$role->id) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row gy-4">
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Name</label>
                            <input value="{{ old('name',$role->name) }}" placeholder="Enter Name" name="name" type="text" class="form-control" >
                            @error('name')
                                <p class="text-red-400 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            @if ($permissions->isNotEmpty())
                                    @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                        <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }} type="checkbox" class="form-check-input rounded" name="permission[]" id="permission-{{ $permission->id }}" value="{{ $permission->name }}">
                                        <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                    @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
