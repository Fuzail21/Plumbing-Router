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
                <h3 class="card-title">Deleted Records List</h3>
                
                <div class="card-tools d-flex justify-content-between align-items-center">
                    {{-- <a href="{{ route('user.add') }}" class="btn btn-sm btn-primary me-3 mt-0">Add User</a> --}}

                    <div>
                        <ul class="pagination pagination-sm float-end mb-0">
                            <!-- Previous Page Link -->
                            @if ($jobs->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $jobs->previousPageUrl() }}">&laquo;</a></li>
                            @endif

                            @php
                                $start = max(1, $jobs->currentPage() - 2);
                                $end = min($jobs->lastPage(), $jobs->currentPage() + 2);
                            @endphp

                            <!-- First Page -->
                            @if ($start > 1)
                                <li class="page-item"><a class="page-link" href="{{ $jobs->url(1) }}">1</a></li>
                                @if ($start > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            <!-- Page Number Links -->
                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $jobs->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $jobs->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Last Page -->
                            @if ($end < $jobs->lastPage())
                                @if ($end < $jobs->lastPage() - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $jobs->url($jobs->lastPage()) }}">{{ $jobs->lastPage() }}</a></li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($jobs->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $jobs->nextPageUrl() }}">&raquo;</a></li>
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
                            <th><a href="#" class="sort" data-column="jobType" data-order="asc" style="color: inherit; text-decoration: none;">Job Type</a></th>
                            <th><a href="#" class="sort" data-column="j.jobId" data-order="asc" style="color: inherit; text-decoration: none;">Job #</a></th>
                            <th><a href="#" class="sort" data-column="descript" data-order="asc" style="color: inherit; text-decoration: none;">Description</a></th>
                            <th><a href="#" class="sort" data-column="phase" data-order="asc" style="color: inherit; text-decoration: none;">Phase</a></th>
                            <th><a href="#" class="sort" data-column="units" data-order="asc" style="color: inherit; text-decoration: none;">Units</a></th>
                            <th><a href="#" class="sort" data-column="material" data-order="asc" style="color: inherit; text-decoration: none;">Material</a></th>
                            <th><a href="#" class="sort" data-column="sys" data-order="asc" style="color: inherit; text-decoration: none;">System</a></th>
                            <th><a href="#" class="sort" data-column="bldFloor" data-order="asc" style="color: inherit; text-decoration: none;">BLDG Floor</a></th>
                            <th><a href="#" class="sort" data-column="zoneUnit" data-order="asc" style="color: inherit; text-decoration: none;">Zone - Unit</a></th>
                            <th><a href="#" class="sort" data-column="dx" data-order="asc" style="color: inherit; text-decoration: none;">D-X</a></th>
                            <th>Job # - System - Location - BLDG Floor - Zone - Unit</th>
                            <th><a href="#" class="sort" data-column="dateNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Date Needed</a></th>
                            <th><a href="#" class="sort" data-column="old_dateNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Old Date Needed</a></th>
                            <th><a href="#" class="sort" data-column="engNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Eng Date Needed</a></th>
                            <th><a href="#" class="sort" data-column="old_engNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Old Eng Date Needed</a></th>

                            <th><a href="#" class="sort" data-column="engComplete" data-order="asc" style="color: inherit; text-decoration: none;">ENG Complete</a></th>
                            <th><a href="#" class="sort" data-column="prwr" data-order="asc" style="color: inherit; text-decoration: none;">WRHS Misc Complete</a></th>
                            <th><a href="#" class="sort" data-column="fabmisc" data-order="asc" style="color: inherit; text-decoration: none;">FAB Misc Complete</a></th>
                            <th><a href="#" class="sort" data-column="fabwr" data-order="asc" style="color: inherit; text-decoration: none;">FAB Complete</a></th>

                            <th><a href="#" class="sort" data-column="shipComplete" data-order="asc" style="color: inherit; text-decoration: none;">Ship Complete</a></th>
                            <th><a href="#" class="sort" data-column="roughSuper" data-order="asc" style="color: inherit; text-decoration: none;">Rough Super</a></th>
                            <th><a href="#" class="sort" data-column="finishSuper" data-order="asc" style="color: inherit; text-decoration: none;">Finish Super</a></th>
                            <th><a href="#" class="sort" data-column="engineer" data-order="asc" style="color: inherit; text-decoration: none;">Engineer</a></th>
                            <th><a href="#" class="sort" data-column="pActManager" data-order="asc" style="color: inherit; text-decoration: none;">PM/Act Manager</a></th>
                            <!-- <th><a href="#" class="sort" data-column="wrhs2_feb" data-order="asc" style="color: inherit; text-decoration: none;">WRHS to FAB</a></th> -->
                            <th><a href="#" class="sort" data-column="notes" data-order="asc" style="color: inherit; text-decoration: none;">Notes</a></th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="jobs-table">
                        @if($jobs->isEmpty())
                            <tr>
                                <td colspan="25" style="text-align: center;">No records found.</td>
                            </tr>
                        @else
                            @foreach($jobs as $row)
                                <tr class="align-middle">
                                    <td>{{ $row->jobType }}</td>
                                    <td>{{ $row->jobId }}</td>
                                    <td>{{ $row->descript }}</td>
                                    <td>{{ $row->phase }}</td>
                                    <td>{{ $row->units }}</td>
                                    <td>{{ $row->material }}</td>
                                    <td>{{ $row->sys }}</td>
                                    <td>{{ $row->bldFloor }}</td>
                                    <td>{{ $row->zoneUnit }}</td>
                                    <td>{{ $row->dx }}</td>
                                    <td>{{ $row->jobId }} - {{ $row->sys }} - {{ $row->bldFloor }} - {{ $row->zoneUnit }} - {{ $row->dx }}</td>
                                    <td>{{ $row->dateNeeded ? \Carbon\Carbon::parse($row->dateNeeded)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $row->old_dateNeeded ? \Carbon\Carbon::parse($row->old_dateNeeded)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $row->engNeeded ? \Carbon\Carbon::parse($row->engNeeded)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $row->old_engNeeded ? \Carbon\Carbon::parse($row->old_engNeeded)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $row->engComplete ? \Carbon\Carbon::parse($row->engComplete)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $row->prwr }}</td>
                                    <td>{{ $row->fabmisc }}</td>
                                    <td>{{ $row->fabwr ? \Carbon\Carbon::parse($row->fabwr)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $row->shipComplete ? \Carbon\Carbon::parse($row->shipComplete)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $row->roughSuper }}</td>
                                    <td>{{ $row->finishSuper }}</td>
                                    <td>{{ $row->engineer }}</td>
                                    <td>{{ $row->pActManager }}</td>
                                    {{-- <!-- <td>{{ $row->wrhs2_feb }}</td> --> --}}
                                    <td>{{ $row->notes }}</td>
                                    

                                    <td>
                                        <form action="{{ route('jobs.restore', $row->recnum) }}" method="POST" onsubmit="return confirm('Are you sure you want to restore this job?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-md text-success" title="Restore" style="background: none; border: none;">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('jobs.hardDelete', $row->recnum) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this record.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md text-danger" title="Hard Delete" style="background: none; border: none;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                
                    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                           <strong> Are you sure you want to delete this job?  </strong>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" 
                                    data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteForm" method="POST" action="">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                </div> <!-- /.table-responsive -->
            </div> <!-- /.card-body -->
        </div>
    </div>

@endsection


@section('js')
    <script>

        function confirmDelete(recnum) {
            let url = `/jobs/hard-delete/${recnum}`;
            document.getElementById('deleteForm').action = url;
            new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
        }

    </script>
@endsection