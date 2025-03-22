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

        table th {
            min-width: 100px;
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

            table th {
                min-width: 100px;
            }

        }
    </style>
@endsection

@section('content')


    <form style="max-width: 100%; margin: auto; text-align: center; background-color: #FFFFFF; padding: 2%; border: 1px solid #ddd; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Job Type</label>
                <select name="jobType" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
                    <option {{ request('jobType') == 'both' ? 'selected' : '' }} value="both">COM & SFH</option>
                    <option {{ request('jobType') == 'COM' ? 'selected' : '' }} value="COM">COM</option>
                    <option {{ request('jobType') == 'SFH' ? 'selected' : '' }} value="SFH">SFH</option>
                </select>
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Job Number</label>
                <input type="text" value="{{ request('jobNumber') }}" name="jobNumber" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Material</label>
                <input type="text" value="{{ request('material') }}" name="material" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>System</label>
                <input type="text" value="{{ request('sys') }}" name="sys" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Blf-Floor</label>
                <input type="text" value="{{ request('blf_floor') }}" name="blf_floor" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Zone-Units</label>
                <input type="text" value="{{ request('units') }}" name="units" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
           
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; margin-top: 15px;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Date Needed</label>
                <input type="date" value="{{ request('dataNeeded') }}" name="dataNeeded" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Eng Date Needed</label>
                <input type="date" value="{{ request('engDateNeeded') }}" name="engDateNeeded" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Eng Complete</label>
                <input type="date" value="{{ request('engComplete') }}" name="engComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>WRHS Misc Complete</label>
                <input type="date" value="{{ request('wrhsMiscComplete') }}" name="wrhsMiscComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>FAB Complete</label>
                <input type="date" value="{{ request('fabComplete') }}" name="fabComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>FAB Misc Complete</label>
                <input type="date" value="{{ request('fabMiscComplete') }}" name="fabMiscComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        </div>


        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; margin-top: 15px;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Ship Complete</label>
                <input type="date" value="{{ request('shipComplete') }}" name="shipComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
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

        <button type="submit" style="margin-top: 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px;">
            SEARCH
        </button>
    </form>

    <form method="POST" action="{{ route('export.excel_bulk_edit') }}">
        @csrf
        <button type="submit" style="width: 100%; max-width: 200px; margin: 20px 0 20px 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s; display: block; text-align: center;">
            <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
        </button>
    </form>
    

    

    <div class="app-content">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"></h3>
                @if ($bulkEdit instanceof \Illuminate\Pagination\LengthAwarePaginator && $bulkEdit->total() > 0)
                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-end">
                            <!-- Previous Page Link -->
                            @if ($bulkEdit->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $bulkEdit->previousPageUrl() }}">&laquo;</a></li>
                            @endif

                            @php
                                $start = max(1, $bulkEdit->currentPage() - 2);
                                $end = min($bulkEdit->lastPage(), $bulkEdit->currentPage() + 2);
                            @endphp

                            <!-- First Page -->
                            @if ($start > 1)
                                <li class="page-item"><a class="page-link" href="{{ $bulkEdit->url(1) }}">1</a></li>
                                @if ($start > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            <!-- Page Number Links -->
                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $bulkEdit->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $bulkEdit->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Last Page -->
                            @if ($end < $bulkEdit->lastPage())
                                @if ($end < $bulkEdit->lastPage() - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $bulkEdit->url($bulkEdit->lastPage()) }}">{{ $bulkEdit->lastPage() }}</a></li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($bulkEdit->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $bulkEdit->nextPageUrl() }}">&raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                @endif

            </div>
    
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="jobTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Job Type</th>
                                <th>Job #</th>
                                <th>Descr</th>
                                <th>Phase</th>
                                <th>Units</th>
                                <th>Material</th>
                                <th>System</th>
                                <th>BLDG Floor</th>
                                <th>Zone - Unit</th>
                                <th>D-X</th>
                                <th>Job # - System - Location</th>
                                <th>Date Needed</th>
                                <th>Old Date Needed</th>
                                <th>Eng Date Needed</th>
                                <th>Old Eng Date Needed</th>
                                <th>ENG Complete</th>
                                <th>WRHS Misc Complete</th>
                                <th>FAB Complete</th>
                                <th>FAB Misc Complete</th>
                                <th>Ship Complete</th>
                                <th>Rough Super</th>
                                <th>Finish Super</th>
                                <th>Engineer</th>
                                <th>PM/Act Manager</th>
                                <!-- <th>WRHS to FAB</th> -->
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($bulkEdit->isEmpty())
                                <tr>
                                    <td colspan="27" style="text-align: center;">No records found. Please enter search criteria.</td>
                                </tr>
                            @else
                                @foreach($bulkEdit as $search)
                                    <tr class="align-middle" data-id="{{ $search->recnum }}">
                                        <td data-id="{{ $search->recnum }}" data-column="jobType">{{ $search->jobType }}</td>
                                        <td data-id="{{ $search->recnum }}" data-column="jobId">{{ $search->jobId }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="descript">{{ $search->descript }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="phase">{{ $search->phase }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="units">{{ $search->units }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="material">{{ $search->material }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="sys">{{ $search->sys }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="bldFloor">{{ $search->bldFloor }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="zoneUnit">{{ $search->zoneUnit }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="dx">{{ $search->dx }}</td>
                                        <td>{{ (int) $search->jobId - (int) $search->sys - (int) $search->dx }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="dateNeeded">{{ $search->dateNeeded ? \Carbon\Carbon::parse($search->dateNeeded)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->old_dateNeeded ? \Carbon\Carbon::parse($search->old_dateNeeded)->format('m / d / Y') : '' }}</td>

                                        <td contenteditable="true" data-id="{{ $search->recnum }}"  data-column="engNeeded">{{ $search->engNeeded ? \Carbon\Carbon::parse($search->engNeeded)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->old_engNeeded ? \Carbon\Carbon::parse($search->old_engNeeded)->format('m / d / Y') : '' }}</td>

                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="engComplete">{{ $search->engComplete ? \Carbon\Carbon::parse($search->engComplete)->format('m / d / Y') : '' }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="prwr">{{ $search->prwr }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="fabwr">{{ $search->fabwr ? \Carbon\Carbon::parse($search->fabwr)->format('m / d / Y') : '' }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="fabmisc">{{ $search->fabmisc }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="shipComplete">{{ $search->shipComplete ? \Carbon\Carbon::parse($search->shipComplete)->format('m / d / Y') : '' }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="roughSuper">{{ $search->roughSuper }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="finishSuper">{{ $search->finishSuper }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="engineer">{{ $search->engineer }}</td>
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="pActManager">{{ $search->pActManager }}</td>
                                        <!-- <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="wrhs2_feb">{{ $search->wrhs2_feb }}</td> -->
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="notes">{{ $search->notes }}</td>
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
    

    <!-- Floating Button -->
    {{-- <a href="{{ route('form.add') }}" class="floating-btn">
        <i class="bi bi-plus"></i>
    </a> --}}

@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- @section('scripts') --}}
    <script>
        $(document).ready(function () {
            $("#jobTable td[contenteditable='true']").on("blur", function () {
                let recnum = $(this).data("id"); // Get job ID
                let column = $(this).data("column"); // Get column name
                let value = $(this).text().trim(); // Get updated value
            
                $.ajax({
                    url: `/update-job/${recnum}`,
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        [column]: value, // Send only the updated field
                    },
                    success: function (response) {
                        // alert("Updated successfully!");
                        if (window.location.search) {
                            const url = new URL(window.location);
                            url.search = ''; // Clears query parameters
                            window.history.replaceState({}, document.title, url);
                        }
                    },
                    error: function () {
                        // alert("Update failed!");
                    }
                });
            });
        });



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









    </script>

{{-- @endsection --}}