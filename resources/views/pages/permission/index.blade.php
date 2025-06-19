@extends('layouts.app')

@section('title', 'Permissions')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Permissions</h1>
                {{-- 
                <div class="section-header-button">
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Add New</a>
                </div> 
                --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Permissions</a></div>
                    <div class="breadcrumb-item">All Permissions</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <h2 class="section-title">Permissions</h2>
                <p class="section-lead">
                    Informasi tentang detail izin karyawan.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Permissions</h4>
                            </div>

                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('permissions.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search by name" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Department</th>
                                                <th>Date Permission</th>
                                                {{-- <th>Is Approval</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $permission)
                                                <tr>
                                                    <td>{{ $permission->user->name }}</td>
                                                    <td>{{ $permission->user->position }}</td>
                                                    <td>{{ $permission->user->department }}</td>
                                                    <td>{{ $permission->date_permission }}</td>
                                                    
                                                    {{-- 
                                                    <td>
                                                        @if ($permission->is_approved == 1)
                                                            Approved
                                                        @else
                                                            Not Approved
                                                        @endif
                                                    </td>
                                                    --}}

                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('permissions.show', $permission->id) }}"
                                                               class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i> Detail
                                                            </a>

                                                            <form action="{{ route('permissions.destroy', $permission->id) }}"
                                                                  method="POST" class="ml-2">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="float-right">
                                    {{ $permissions->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
