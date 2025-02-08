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
                        @if ($jobs->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $jobs->previousPageUrl() }}">&laquo;</a></li>
                        @endif
                
                        <!-- Page Number Links -->
                        @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $jobs->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                
                        <!-- Next Page Link -->
                        @if ($jobs->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $jobs->nextPageUrl() }}">&raquo;</a></li>
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
                                <th>Descr</th>
                                <th>Phase</th>
                                <th>Units</th>
                                <th>Material</th>
                                <th>System</th>
                                <th>Bid - Floor</th>
                                <th>Zone - Unit</th>
                                <th>D-X</th>
                                <th>Job # - System - Location</th>
                                <th>Date Needed</th>
                                <th>Engineering Date Needed</th>
                                <th>ENG Complete</th>
                                <th>WRHS Misc Complete</th>
                                <th>FAB Complete</th>
                                <th>FAB Misc Complete</th>
                                <th>Ship Complete</th>
                                <th>Rough Super</th>
                                <th>Finish Super</th>
                                <th>Engineer</th>
                                <th>PM/Act Manager</th>
                                <th>WRHS to FAB</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr class="align-middle">
                                    <td>{{ $job->jobType }}</td>
                                    <td>{{ $job->jobId }}</td>
                                    <td>{{ $job->descript }}</td>
                                    <td>{{ $job->phase }}</td>
                                    <td>{{ $job->units }}</td>
                                    <td>{{ $job->material }}</td>
                                    <td>{{ $job->sys }}</td>
                                    <td>{{ $job->bldFloor }}</td>
                                    <td>{{ $job->zoneUnit }}</td>
                                    <td>{{ $job->dx }}</td>
                                    <td>{{ (int) $job->jobId - (int) $job->sys - (int) $job->dx }}</td> <!-- Casting to integers to ensure proper subtraction -->
                                    <td>{{ $job->dateNeeded }}</td>
                                    <td>{{ $job->engNeeded }}</td>
                                    <td>{{ $job->engComplete }}</td>
                                    <td>{{ $job->prwr }}</td>
                                    <td>{{ $job->fabwr }}</td>
                                    <td>{{ $job->fabmisc }}</td>
                                    <td>{{ $job->shipComplete }}</td>
                                    <td>{{ $job->roughSuper }}</td>
                                    <td>{{ $job->finishSuper }}</td>
                                    <td>{{ $job->engineer }}</td>
                                    <td>{{ $job->pActManager }}</td>
                                    <td>{{ $job->wrhs2_feb }}</td>
                                    <td>{{ $job->notes }}</td>
                                    <td>
                                        <a href="{{ route('form.edit', ['recnum' => $job->recnum]) }}" class="text-success">
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
