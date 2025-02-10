@extends('layouts.app')

@section('layouts')
    @include('layouts.navigation')
    @include('layouts.sidenavbar')
@endsection

@section('style')
    <style>
        /* Floating Button Styling */
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #021962;
            color: white;
            border-radius: 50%; /* Perfectly round */
            width: 55px;
            height: 55px;
            font-size: 32px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 55px;
            z-index: 9999;
        }

        .floating-btn:hover {
            background-color: #001040;
            color: white;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .app-content {
                min-height: 100vh; /* Ensure it covers the full viewport */
                overflow-y: auto; /* Allow scrolling if needed */
            }

            .table-responsive {
                overflow-x: auto; /* Enable horizontal scrolling */
                white-space: nowrap; /* Prevent text wrapping */
            }

            .floating-btn {
                width: 50px;
                height: 50px;
                font-size: 28px;
                bottom: 15px; /* Adjust for smaller screens */
                right: 15px;
            }
        }
    </style>
@endsection

@section('content')

    <div class="app-content">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-end">
                        <!-- Previous Page Link -->
                        @if ($sfhEng->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $sfhEng->previousPageUrl() }}">&laquo;</a></li>
                        @endif
                    
                        @php
                            $start = max(1, $sfhEng->currentPage() - 2);
                            $end = min($sfhEng->lastPage(), $sfhEng->currentPage() + 2);
                        @endphp
                    
                        <!-- First Page -->
                        @if ($start > 1)
                            <li class="page-item"><a class="page-link" href="{{ $sfhEng->url(1) }}">1</a></li>
                            @if ($start > 2)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                        @endif
                    
                        <!-- Page Number Links -->
                        @for ($page = $start; $page <= $end; $page++)
                            <li class="page-item {{ $page == $sfhEng->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $sfhEng->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor
                    
                        <!-- Last Page -->
                        @if ($end < $sfhEng->lastPage())
                            @if ($end < $sfhEng->lastPage() - 1)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link" href="{{ $sfhEng->url($sfhEng->lastPage()) }}">{{ $sfhEng->lastPage() }}</a></li>
                        @endif
                    
                        <!-- Next Page Link -->
                        @if ($sfhEng->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $sfhEng->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                    
                </div>
            </div> <!-- /.card-header -->

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Job Type</th>
                                <th>Job #</th>
                                <th>Description</th>
                                <th>Phase</th>
                                <th>Units</th>
                                <th>System</th>
                                <th>Bld - Floor</th>
                                <th>Date Needed</th>
                                <th>Rough Super</th>
                                <th>Engineer</th>
                                <th>PM/Act Manager</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sfhEng as $SFH)
                                <tr class="align-middle">
                                    <td>{{ $SFH->jobType }}</td>
                                    <td>{{ $SFH->jobId }}</td>
                                    <td>{{ $SFH->descript }}</td>
                                    <td>{{ $SFH->phase }}</td>
                                    <td>{{ $SFH->units }}</td>
                                    <td>{{ $SFH->sys }}</td>
                                    <td>{{ $SFH->bldFloor }}</td>
                                    <td>{{ $SFH->dateNeeded }}</td>
                                    <td>{{ $SFH->roughSuper }}</td>
                                    <td>{{ $SFH->engineer }}</td>
                                    <td>{{ $SFH->pActManager }}</td>
                                    <td>{{ $SFH->notes }}</td>
                                    <td>
                                        <a href="{{ route('form.edit', ['recnum' => $SFH->recnum]) }}" class="text-success">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>                        
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div> <!-- /.table-responsive -->
            </div> <!-- /.card-body -->
        </div>
    </div>

    <!-- Floating Button -->
    <a href="{{ route('form.add') }}" class="floating-btn">
        <i class="bi bi-plus"></i>
    </a>

@endsection
