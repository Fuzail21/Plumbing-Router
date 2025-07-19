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

        /* Style for newly added editable rows */
        .new-editable-row {
            background-color: #f0f0f0; /* Light grey background */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .app-content {
                min-height: 100vh; /* Ensure it covers the full full viewport */
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
        /* Specific styling for the buttons to ensure perfect alignment */
        .button-group button {
            display: inline-flex; /* Use flexbox for button content */
            align-items: center; /* Vertically center icon and text within the button */
            justify-content: center; /* Horizontally center icon and text within the button */
            height: 40px; /* Explicit height for consistency */
            line-height: 1; /* Reset line-height to allow flexbox to control vertical alignment */
            padding: 10px 20px; /* Adjust padding as needed */
        }
        .button-group button i {
            margin-right: 8px; /* Space between icon and text */
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

    <div class="button-group" style="display: flex; justify-content: flex-start; align-items: center; margin-top: 20px; flex-wrap: nowrap;">
        <form method="POST" action="{{ route('export.excel_bulk_edit') }}" style="margin-right: 20px;">
            @csrf
            <button type="submit" style="max-width: 200px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s; text-align: center; margin-top:15px; margin-left:10px;">
                <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
            </button>
        </form>
        @if(!$bulkEdit->isEmpty())
        <button id="addRowBtn" style="max-width: 200px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s; text-align: center;">
            <i class="bi bi-plus-circle"></i> ADD ROW
        </button>
        @endif
    </div>
    
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
                                <th>Job # - System - Location - BLDG Floor - Zone - Unit</th>
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
                                <th>Action</th> <!-- New Action column header -->
                            </tr>
                        </thead>
                        <tbody>
                            @if($bulkEdit->isEmpty())
                                <tr id="no-records-row">
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
                                        <td>{{ $search->jobId }} - {{ $search->sys }} - {{ $search->bldFloor }} - {{ $search->zoneUnit }} - {{ $search->dx }}</td>
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
                                        {{-- <!-- <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="wrhs2_feb">{{ $search->wrhs2_feb }}</td> --> --}}
                                        <td contenteditable="true" data-id="{{ $search->recnum }}" data-column="notes">{{ $search->notes }}</td>
                                        <td>
                                            <!-- Save button only for new rows, not for existing ones -->
                                        </td>
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
            // Event listener for existing editable cells (updates) - RE-ADDED for explicit save button
            $("#jobTable").on("blur", "td[contenteditable='true']:not([data-id='new-row'])", function () {
                let recnum = $(this).data("id"); // Get job ID
                let column = $(this).data("column"); // Get column name
                let value = $(this).text().trim(); // Get updated value

                // For date fields, ensure format is YYYY-MM-DD for backend
                if ($(this).attr('data-column') && ($(this).attr('data-column').includes('Date') || $(this).attr('data-column').includes('Complete'))) {
                    if (value) {
                        const date = new Date(value);
                        if (!isNaN(date)) {
                            value = date.toISOString().slice(0, 10); // YYYY-MM-DD
                        } else {
                            value = ''; // Clear if invalid date
                        }
                    }
                }
            
                $.ajax({
                    url: `/update-job/${recnum}`,
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        [column]: value, // Send only the updated field
                    },
                    success: function (response) {
                        console.log("Updated successfully:", response);
                    },
                    error: function (xhr) {
                        console.error("Update failed:", xhr.responseText);
                    }
                });
            });

            // Event listener for the "ADD ROW" button
            $("#addRowBtn").on("click", function () {
                const $tbody = $("#jobTable tbody");
                const $noRecordsRow = $("#no-records-row");

                // If "No records found" row exists, remove it
                if ($noRecordsRow.length) {
                    $noRecordsRow.remove();
                }

                // Get default values from search form inputs if available
                const defaultJobType = $('select[name="jobType"]').val() === 'both' ? '' : $('select[name="jobType"]').val();
                const defaultJobNumber = $('input[name="jobNumber"]').val();
                const defaultDescription = ''; // No default from search form
                const defaultPhase = ''; // No default from search form
                const defaultUnits = $('input[name="units"]').val();
                const defaultMaterial = $('input[name="material"]').val();
                const defaultSystem = $('input[name="sys"]').val();
                const defaultBldFloor = $('input[name="blf_floor"]').val();
                const defaultZoneUnit = $('input[name="units"]').val(); // Assuming units is also zoneUnit
                const defaultDx = ''; // No default from search form
                const defaultDateNeeded = $('input[name="dataNeeded"]').val();
                const defaultEngNeeded = $('input[name="engDateNeeded"]').val();
                const defaultEngComplete = $('input[name="engComplete"]').val();
                const defaultWrhsMiscComplete = $('input[name="wrhsMiscComplete"]').val();
                const defaultFabComplete = $('input[name="fabComplete"]').val();
                const defaultFabMiscComplete = $('input[name="fabMiscComplete"]').val();
                const defaultShipComplete = $('input[name="shipComplete"]').val();
                const defaultRoughSuper = $('input[name="roughSuper"]').val();
                const defaultFinishSuper = ''; // No default from search form
                const defaultEngineer = $('input[name="engineer"]').val();
                const defaultPmActManager = $('input[name="pmActManager"]').val();
                const defaultNotes = ''; // No default from search form


                // Create a new table row
                const newRow = `
                    <tr class="align-middle new-editable-row" data-id="new-row">
                        <td data-id="new-row" data-column="jobType" contenteditable="true">${defaultJobType}</td>
                        <td data-id="new-row" data-column="jobId" contenteditable="true">${defaultJobNumber}</td>
                        <td data-id="new-row" data-column="descript" contenteditable="true">${defaultDescription}</td>
                        <td data-id="new-row" data-column="phase" contenteditable="true">${defaultPhase}</td>
                        <td data-id="new-row" data-column="units" contenteditable="true">${defaultUnits}</td>
                        <td data-id="new-row" data-column="material" contenteditable="true">${defaultMaterial}</td>
                        <td data-id="new-row" data-column="sys" contenteditable="true">${defaultSystem}</td>
                        <td data-id="new-row" data-column="bldFloor" contenteditable="true">${defaultBldFloor}</td>
                        <td data-id="new-row" data-column="zoneUnit" contenteditable="true">${defaultZoneUnit}</td>
                        <td data-id="new-row" data-column="dx" contenteditable="true">${defaultDx}</td>
                        <td></td> <!-- Job # - System - Location - BLDG Floor - Zone - Unit (will be calculated after save) -->
                        <td data-id="new-row" data-column="dateNeeded" contenteditable="true">${defaultDateNeeded}</td>
                        <td></td> <!-- Old Date Needed (not editable for new row) -->
                        <td data-id="new-row" data-column="engNeeded" contenteditable="true">${defaultEngNeeded}</td>
                        <td></td> <!-- Old Eng Date Needed (not editable for new row) -->
                        <td data-id="new-row" data-column="engComplete" contenteditable="true">${defaultEngComplete}</td>
                        <td data-id="new-row" data-column="prwr" contenteditable="true">${defaultWrhsMiscComplete}</td>
                        <td data-id="new-row" data-column="fabwr" contenteditable="true">${defaultFabComplete}</td>
                        <td data-id="new-row" data-column="fabmisc" contenteditable="true">${defaultFabMiscComplete}</td>
                        <td data-id="new-row" data-column="shipComplete" contenteditable="true">${defaultShipComplete}</td>
                        <td data-id="new-row" data-column="roughSuper" contenteditable="true">${defaultRoughSuper}</td>
                        <td data-id="new-row" data-column="finishSuper" contenteditable="true">${defaultFinishSuper}</td>
                        <td data-id="new-row" data-column="engineer" contenteditable="true">${defaultEngineer}</td>
                        <td data-id="new-row" data-column="pActManager" contenteditable="true">${defaultPmActManager}</td>
                        <td data-id="new-row" data-column="notes" contenteditable="true">${defaultNotes}</td>
                        <td>
                            <button class="save-row-btn" data-id="new-row" style="background-color: #021962; color: white; border: none; border-radius: 5px; padding: 5px 10px; cursor: pointer;">
                                <i class="bi bi-check-circle"></i> Save
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(newRow);

                // Focus on the first editable cell of the new row
                $tbody.find('tr.new-editable-row:last-child td[contenteditable="true"]:first').focus();
            });

            // Event listener for newly added editable cells (inserts) - Modified to not send AJAX on blur
            $("#jobTable").on("blur", "td[contenteditable='true'][data-id='new-row']", function () {
                const $row = $(this).closest('tr');
                // Check if any data has been entered in the new row
                let hasData = false;
                $row.find('td[contenteditable="true"]').each(function() {
                    if ($(this).text().trim() !== '') {
                        hasData = true;
                        return false; // Break the loop
                    }
                });

                if (!hasData) {
                    // If no data, remove the row if it's empty
                    $row.remove();
                    // If no other rows, bring back "No records found"
                    if ($("#jobTable tbody tr").length === 0) {
                        $("#jobTable tbody").append('<tr id="no-records-row"><td colspan="27" style="text-align: center;">No records found. Please enter search criteria.</td></tr>');
                    }
                }
                // No AJAX call on blur for new rows; saving is explicit via button
            });

            // Event listener for the "Save" button on each row
            $("#jobTable").on("click", ".save-row-btn", function () {
                const $button = $(this);
                const $row = $button.closest('tr');
                const recnum = $row.data('id');
                const isNewRow = (recnum === 'new-row');

                // Disable button to prevent multiple clicks
                $button.prop('disabled', true).css('opacity', '0.6');

                // Collect all data from the row
                let rowData = {};
                $row.find('td[contenteditable="true"]').each(function() {
                    let column = $(this).data('column');
                    let value = $(this).text().trim();
                    // For date fields, ensure format is YYYY-MM-DD for backend
                    if ($(this).attr('data-column') && ($(this).attr('data-column').includes('Date') || $(this).attr('data-column').includes('Complete'))) {
                        if (value) {
                            const date = new Date(value);
                            if (!isNaN(date)) {
                                value = date.toISOString().slice(0, 10); // YYYY-MM-DD
                            } else {
                                value = ''; // Clear if invalid date
                            }
                        }
                    }
                    // For new rows, wrap values in an array to match backend's bulk insert expectation
                    // For existing rows, send as direct value
                    rowData[column] = isNewRow ? [value] : value;
                });

                // Check if any data has been entered in a new row before attempting to save
                if (isNewRow) {
                    const hasData = Object.values(rowData).some(val => (Array.isArray(val) ? val[0] : val) !== '');
                    if (!hasData) {
                        console.warn("No data entered for new row. Not saving.");
                        $row.remove(); // Remove the empty new row
                        // If no other rows, bring back "No records found"
                        if ($("#jobTable tbody tr").length === 0) {
                            $("#jobTable tbody").append('<tr id="no-records-row"><td colspan="27" style="text-align: center;">No records found. Please enter search criteria.</td></tr>');
                        }
                        $button.prop('disabled', false).css('opacity', '1'); // Re-enable button
                        return;
                    }
                }

                let url = isNewRow ? `/insert-job` : `/update-job/${recnum}`;
                let type = isNewRow ? "POST" : "PUT";

                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        _token: "{{ csrf_token() }}",
                        ...rowData
                    },
                    success: function (response) {
                        console.log("Operation successful:", response);
                        if (isNewRow && response.success && response.recnums && response.recnums.length > 0) {
                            const newRecnum = response.recnums[0];
                            $row.data('id', newRecnum);
                            $row.find('td').each(function() {
                                $(this).data('id', newRecnum);
                            });
                            $row.removeClass('new-editable-row'); // Remove grey background
                            $button.remove(); // Remove the save button after successful save for a new row

                            // Update the "Job # - System - Location" cell
                            const jobId = $row.find('td[data-column="jobId"]').text().trim();
                            const sys = $row.find('td[data-column="sys"]').text().trim();
                            const bldFloor = $row.find('td[data-column="bldFloor"]').text().trim();
                            const zoneUnit = $row.find('td[data-column="zoneUnit"]').text().trim();
                            const dx = $row.find('td[data-column="dx"]').text().trim();
                            $row.find('td:eq(10)').text(`${jobId} - ${sys} - ${bldFloor} - ${zoneUnit} - ${dx}`); // Update the 11th column (index 10)
                        } else if (!isNewRow) {
                             // Re-enable button for existing row updates (if this logic was to be used for them)
                             $button.prop('disabled', false).css('opacity', '1');
                        }
                    },
                    error: function (xhr) {
                        console.error("Operation failed:", xhr.responseText);
                        if (isNewRow) {
                            $row.remove(); // Remove the unsaved new row on error
                            // If no other rows, bring back "No records found"
                            if ($("#jobTable tbody tr").length === 0) {
                                $("#jobTable tbody").append('<tr id="no-records-row"><td colspan="27" style="text-align: center;">No records found. Please enter search criteria.</td></tr>');
                            }
                        }
                        $button.prop('disabled', false).css('opacity', '1'); // Re-enable button
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