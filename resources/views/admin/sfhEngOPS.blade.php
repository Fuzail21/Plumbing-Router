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

        thead th {
            white-space: nowrap;
            min-width: 100px; /* Adjust as needed */
        }


        .table-container {
            position: relative;
            overflow-x: auto;
            padding-bottom: 20px; /* Ensure space for the floating scrollbar */
        }
        
        .table-responsive {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 20px; /* Prevent overlap */
        }
        
        .floating-scrollbar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 16px; /* Height of the scrollbar */
            overflow-x: auto;
            overflow-y: hidden;
            background: #f1f1f1;
            z-index: 1000;
        }
        
        .floating-scrollbar div {
            height: 1px; /* Invisible but allows scrolling */
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

            thead th {
                white-space: nowrap;
                min-width: 100px; /* Adjust as needed */
            }
        }
    </style>
@endsection

@section('content')


    <form style="max-width: 100%; margin: 3%; text-align: center; background-color: #FFFFFF; padding: 2%; border: 1px solid #ddd; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Job Number</label>
                <input type="text" value="{{ request('jobNumber') }}" name="jobNumber" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Description</label>
                <input type="text" value="{{ request('description') }}" name="description" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Phase</label>
                <input type="text" value="{{ request('phase') }}" name="phase" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Units</label>
                <input type="text" value="{{ request('units') }}" name="units" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>System</label>
                <input type="text" value="{{ request('sys') }}" name="sys" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Bldg-Floor</label>
                <input type="text" value="{{ request('blf_floor') }}" name="blf_floor" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; margin-top: 15px;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Date Needed From</label>
                <input type="date" value="{{ request('dataNeeded_from') }}" name="dataNeeded_from" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Date Needed To</label>
                <input type="date" value="{{ request('dataNeeded_to') }}" name="dataNeeded_to" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Eng Complete</label>
                <input type="text" value="{{ request('engComplete') }}" name="engComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Rough Super</label>
                <input type="text" value="{{ request('roughSuper') }}" name="roughSuper" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Engineer</label>
                <input type="text" value="{{ request('engineer') }}" name="engineer" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>PM Act Manager</label>
                <input type="text" value="{{ request('pmActManager') }}" name="pmActManager" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; margin-top: 15px;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>WRHS2 Feb</label>
                <input type="text" value="{{ request('wrhs2Feb') }}" name="wrhs2Feb" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        </div>

        <button type="submit" style="margin-top: 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px;">
            SEARCH
        </button>
    </form>

    <form method="POST" action="{{ route('export.excel_sfh-eng-ops') }}">
        @csrf
        <button type="submit" style="width: 100%; max-width: 200px; margin: 20px 0 20px 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s; display: block; text-align: center;">
            <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
        </button>
    </form>


    

    <div class="app-content">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"></h3>
                @if ($sfhEngOps instanceof \Illuminate\Pagination\LengthAwarePaginator && $sfhEngOps->total() > 0)
                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-end">
                            <!-- Previous Page Link -->
                            @if ($sfhEngOps->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $sfhEngOps->previousPageUrl() }}">&laquo;</a></li>
                            @endif
                    
                            @php
                                $start = max(1, $sfhEngOps->currentPage() - 2);
                                $end = min($sfhEngOps->lastPage(), $sfhEngOps->currentPage() + 2);
                            @endphp
                    
                            <!-- First Page -->
                            @if ($start > 1)
                                <li class="page-item"><a class="page-link" href="{{ $sfhEngOps->url(1) }}">1</a></li>
                                @if ($start > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif
                    
                            <!-- Page Number Links -->
                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $sfhEngOps->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $sfhEngOps->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor
                    
                            <!-- Last Page -->
                            @if ($end < $sfhEngOps->lastPage())
                                @if ($end < $sfhEngOps->lastPage() - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $sfhEngOps->url($sfhEngOps->lastPage()) }}">{{ $sfhEngOps->lastPage() }}</a></li>
                            @endif
                    
                            <!-- Next Page Link -->
                            @if ($sfhEngOps->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $sfhEngOps->nextPageUrl() }}">&raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                @endif

            </div> <!-- /.card-header -->
    
            <div class="card-body p-0">
                <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Job Type</th>
                                    <th>Job #</th>
                                    <th>Job Name</th>
                                    <th>Phase</th>
                                    <th>Units</th>
                                    <th>Materials</th>
                                    <th>System</th>
                                    <th>BLDG Floor</th>
                                    <th>Zone - Unit</th>
                                    <th>Job # - System - Location</th>
                                    <th>New Date Needed</th>
                                    <th>Date Needed</th>
                                    <th>Rough Super</th>
                                    <th>Engineer</th>
                                    <th>Finish Super</th>
                                    @auth
                                        <th colspan="2">Action</th>
                                    @endauth
                                </tr>
                            </thead>
                            <tbody>
                                @if($sfhEngOps->isEmpty())
                                <tr>
                                    <td colspan="16" style="text-align: center;">No records found. Please enter search criteria.</td>
                                </tr>
                                @else
                                    @foreach($sfhEngOps as $SFH)
                                        <tr class="align-middle">
                                            <td>{{ $SFH->jobType }}</td>
                                            <td>{{ $SFH->jobId }}</td>
                                            <td>{{ $SFH->descript }}</td>
                                            <td>{{ $SFH->phase }}</td>
                                            <td>{{ $SFH->units }}</td>
                                            <td>{{ $SFH->material }}</td>
                                            <td>{{ $SFH->sys }}</td>
                                            <td>{{ $SFH->bldFloor }}</td>
                                            <td>{{ $SFH->zoneUnit }}</td>
                                            <td>{{ $SFH->jobId }} - {{ $SFH->sys }}</td>
                                            <td>{{ $SFH->dateNeeded ? \Carbon\Carbon::parse($SFH->dateNeeded)->format('m / d / Y') : '' }}</td>
                                            <td>{{ $SFH->old_dateNeeded ? \Carbon\Carbon::parse($SFH->old_dateNeeded)->format('m / d / Y') : '' }}</td>
                                            <td>{{ $SFH->roughSuper }}</td>
                                            <td>{{ $SFH->engineer }}</td>
                                            <td>{{ $SFH->finishSuper }}</td>
                                            @auth
                                                <td>
                                                    <a href="{{ route('form.edit', ['recnum' => $SFH->recnum]) }}" class="text-success">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </td>    
                                                <td>
                                                    <button class="btn text-danger p-0" style="background: none; border: none;"
                                                            onclick="confirmDelete({{ $SFH->recnum }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>  
                                            @endauth                  
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                </div> <!-- /.table-responsive -->
            </div> <!-- /.card-body -->

            <div class="floating-scrollbar"><div></div></div>

        </div>
    </div>
    
     <!-- Confirmation Modal -->
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

    <!-- Floating Button -->
    <a href="{{ route('form.add') }}" class="floating-btn">
        <i class="bi bi-plus"></i>
    </a>

@endsection


@section('js')
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            let sideBar = document.querySelector(".app-sidebar");
            let tableContainer = document.querySelector(".table-responsive");
            let floatingScrollbar = document.querySelector(".floating-scrollbar");
            let scrollbarContent = floatingScrollbar.querySelector("div");
            let totalWidthScrollBar = sideBar.scrollWidth + tableContainer.scrollWidth;


            // Set width of floating scrollbar to match the table
            scrollbarContent.style.width = totalWidthScrollBar + "px";

            // Sync scrolling
            floatingScrollbar.addEventListener("scroll", function () {
                tableContainer.scrollLeft = floatingScrollbar.scrollLeft;
            });
        
            tableContainer.addEventListener("scroll", function () {
                floatingScrollbar.scrollLeft = tableContainer.scrollLeft;
            });
        });

        function confirmDelete(recnum) {
            let url = `/recnum/delete/${recnum}`;
            document.getElementById('deleteForm').action = url;
            new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
        }

    </script>
@endsection