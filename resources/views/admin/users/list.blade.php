@extends('layouts.app')

@section('layouts')
    @include('layouts.navigation')
    @include('layouts.sidenavbar')
@endsection

@section('style')
    <style>
        thead th {
            white-space: nowrap;
            min-width: 100px; /* Adjust as needed */
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .app-content {
                min-height: 100vh; /* Ensure it covers the full viewport */
                overflow-y: auto; /* Allow scrolling if needed */
            }

            thead th {
                white-space: nowrap;
                min-width: 100px; /* Adjust as needed */
            }
        }
    </style>
@endsection

@section('content')

    <div class="app-content">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Users List</h3>
                
                <div class="card-tools d-flex justify-content-between align-items-center">
                    <a href="{{ route('user.add') }}" class="btn btn-sm btn-primary me-3 mt-0">Add User</a>

                    <div>
                        <ul class="pagination pagination-sm float-end mb-0">
                            <!-- Previous Page Link -->
                            @if ($users->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">&laquo;</a></li>
                            @endif

                            @php
                                $start = max(1, $users->currentPage() - 2);
                                $end = min($users->lastPage(), $users->currentPage() + 2);
                            @endphp

                            <!-- First Page -->
                            @if ($start > 1)
                                <li class="page-item"><a class="page-link" href="{{ $users->url(1) }}">1</a></li>
                                @if ($start > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            <!-- Page Number Links -->
                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Last Page -->
                            @if ($end < $users->lastPage())
                                @if ($end < $users->lastPage() - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a></li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($users->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">&raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                </div>



            </div> <!-- /.card-header -->

            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="user-table">
                        @if($users->isEmpty())
                            <tr>
                                <td colspan="25" style="text-align: center;">No records found.</td>
                            </tr>
                        @else
                            @foreach($users as $user)
                                <tr class="align-middle">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->designation }}</td>                                    
                                    <td>
                                        <a href="{{ route('user.edit', ['id' => $user->id] ) }}" class="text-success">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('user.delete', ['id' => $user->id] ) }}" class="text-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                </div> <!-- /.table-responsive -->
            </div> <!-- /.card-body -->
        </div>
    </div>

@endsection