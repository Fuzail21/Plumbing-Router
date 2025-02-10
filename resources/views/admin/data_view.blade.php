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
                        @if ($dataView->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $dataView->previousPageUrl() }}">&laquo;</a></li>
                        @endif
                    
                        @php
                            $start = max(1, $dataView->currentPage() - 2);
                            $end = min($dataView->lastPage(), $dataView->currentPage() + 2);
                        @endphp
                    
                        <!-- First Page -->
                        @if ($start > 1)
                            <li class="page-item"><a class="page-link" href="{{ $dataView->url(1) }}">1</a></li>
                            @if ($start > 2)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                        @endif
                    
                        <!-- Page Number Links -->
                        @for ($page = $start; $page <= $end; $page++)
                            <li class="page-item {{ $page == $dataView->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $dataView->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor
                    
                        <!-- Last Page -->
                        @if ($end < $dataView->lastPage())
                            @if ($end < $dataView->lastPage() - 1)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link" href="{{ $dataView->url($dataView->lastPage()) }}">{{ $dataView->lastPage() }}</a></li>
                        @endif
                    
                        <!-- Next Page Link -->
                        @if ($dataView->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $dataView->nextPageUrl() }}">&raquo;</a></li>
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
                                <th>System</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataView as $data)
                                <tr class="align-middle">
                                    <td>{{ $data->jobType }}</td>
                                    <td>{{ $data->jobId }}</td>                        
                                    <td>{{ $data->sys }}</td>
                                    <td>{{ $data->bldFloor }} - {{ $data->zoneUnit }} - {{ $data->dx }}</td>
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
