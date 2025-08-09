

@extends('layouts.master')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Data Permissions</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Permissions</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
        </div>
    </div>
</div>
<!-- Page Header Close -->
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            @can('create permissions')
            <a href="{{ route('permissions.create') }}" class="btn btn-info me-2 btn-b"><i class="mdi mdi-plus-box me-2 d-inline-block"></i>Create</a>
            @endcan
        </div>
    </div>
</div>
<!-- Page Header Close -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">Name</th>
                                <th class="px-6 py-3 text-left" width="180">Created</th>
                                <th class="px-6 py-3 text-center" width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $permission)
                                <tr class="border-b">
                                    <td class="px-6 py-3 text-left">{{ $permission->id }}</td>
                                    <td class="px-6 py-3 text-left">{{ $permission->name }}</td>
                                    <td class="px-6 py-3 text-left">{{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y')  }}</td>
                                    <td class="px-6 py-3 text-center">
                                        @can('edit permissions')
                                            <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-sm btn-info btn-wave"><i class="ri-edit-line align-middle me-2 d-inline-block"></i>Edit</a>
                                        @endcan

                                        @can('delete permissions')
                                            <a href="javascript:void(0)" onclick="deletePermission({{ $permission->id }})" class="btn btn-sm btn-danger btn-wave"><i class="ri-delete-bin-line align-middle me-2 d-inline-block"></i>Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
<script type="text/javascript">
            function deletePermission(id) {
                if(confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('permissions.destroy') }}",
                        data: {id: id},
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = "{{ route('permissions.index') }}";
                        }
                    });
                }
            }
        </script>
@endsection




