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

    <div class="app-content">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-end">
                        <!-- Previous Page Link -->
                        @if ($warehouse->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="{{ $warehouse->currentPage() - 1 }}" href="{{ $warehouse->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @php
                        $start = max(1, $warehouse->currentPage() - 2);
                        $end = min($warehouse->lastPage(), $warehouse->currentPage() + 2);
                    @endphp

                    <!-- First Page -->
                    @if ($start > 1)
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="1" href="{{ $warehouse->url(1) }}">1</a></li>
                        @if ($start > 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @endif

                    <!-- Page Number Links -->
                    @for ($page = $start; $page <= $end; $page++)
                        <li class="page-item {{ $page == $warehouse->currentPage() ? 'active' : '' }}">
                            <a class="page-link page-link-ajax" data-page="{{ $page }}" href="{{ $warehouse->url($page) }}">{{ $page }}</a>
                        </li>
                    @endfor

                    <!-- Last Page -->
                    @if ($end < $warehouse->lastPage())
                        @if ($end < $warehouse->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="{{ $warehouse->lastPage() }}" href="{{ $warehouse->url($warehouse->lastPage()) }}">{{ $warehouse->lastPage() }}</a></li>
                    @endif

                    <!-- Next Page Link -->
                    @if ($warehouse->hasMorePages())
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="{{ $warehouse->currentPage() + 1 }}" href="{{ $warehouse->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                    </ul>
                </div>
            </div> <!-- /.card-header -->

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>Job#</th>
                                <th>Description</th>
                                <th>Phase</th>
                                <th>System</th>
                                <th>Material</th>
                                <th>Job # - System - Location - BLDG Floor - Zone - Unit</th>
                                <th>Date-Needed</th>
                                <th>Units</th>
                                <th>ENG Complete</th>
                                <th>WRHS Misc Complete</th>
                                <th>Prior to Fab Completed</th>
                                <th>FAB Complete</th>
                                <th>Ship Complete</th>                                
                                <th>Rough-Super</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($warehouse as $warehouse)
                                <tr class="align-middle">
                                    <td>{{ $warehouse->jobId }}</td>
                                    <td>{{ $warehouse->descript }}</td>
                                    <td>{{ $warehouse->phase }}</td>
                                    <td>{{ $warehouse->sys }}</td>
                                    <td>{{ $warehouse->material }}</td>
                                    <td>{{ $warehouse->jobId }} - {{ $warehouse->sys }} - {{ $warehouse->bldFloor }} - {{ $warehouse->zoneUnit }} - {{ $warehouse->dx }}</td>
                                    <td>{{ $warehouse->dateNeeded ? \Carbon\Carbon::parse($warehouse->dateNeeded)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $warehouse->units }}</td>
                                    <td>{{ $warehouse->engComplete ? \Carbon\Carbon::parse($warehouse->engComplete)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $warehouse->prwr }}</td>
                                    <td>{{ $warehouse->fabmisc }}</td>
                                    <td>{{ $warehouse->fabwr ? \Carbon\Carbon::parse($warehouse->fabwr)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $warehouse->shipComplete ? \Carbon\Carbon::parse($warehouse->shipComplete)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $warehouse->roughSuper }}</td>
                                    <td>{{ $warehouse->notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.table-responsive -->
            </div> <!-- /.card-body -->

            <div class="floating-scrollbar"><div></div></div>


        </div>
    </div>

     <!-- Confirmation Modal -->
    {{-- <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
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
    </div> --}}

    <!-- Floating Button -->
    <a href="{{ route('form.add') }}" class="floating-btn">
        <i class="bi bi-plus"></i>
    </a>

@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
    // Retrieve current sorting settings from session (or defaults)
    let currentColumn = "{{ session('data_sort_column_warehouse', 'j.recnum') }}";
    let currentOrder = "{{ session('data_sort_direction_warehouse', 'desc') }}";

    // Function to update sorting indicators (arrows)
    function updateSortingIndicators() {
        $('.sort').each(function () {
            let column = $(this).data('column');
            if (column === currentColumn) {
                $(this).html($(this).text().split(' ')[0] + (currentOrder === 'asc' ? ' 🔼' : ' 🔽'));
            } else {
                $(this).html($(this).text().split(' ')[0]); // Reset others
            }
        });
    }

    // Event delegation to ensure the event binds to dynamically loaded elements
    $(document).on('click', '.sort', function (e) {
        e.preventDefault();

        let column = $(this).data('column');

        // Toggle the sort order if clicking the same column, otherwise default to ascending
        if (currentColumn === column) {
            currentOrder = currentOrder === 'asc' ? 'desc' : 'asc'; // Toggle the direction
        } else {
            currentOrder = 'asc'; // Default to ascending when switching columns
        }

        currentColumn = column;

        // Update the sorting indicators immediately
        updateSortingIndicators();

        // Make the AJAX request with the new sorting parameters
        fetchSortedData(1); // Start with the first page
    });

    // Function to fetch sorted data with AJAX
    function fetchSortedData(page) {
        $.ajax({
            url: "{{ route('warehouse') }}",
            type: "GET",
            data: {
                column: currentColumn,
                order: currentOrder,
                page: page
            },
            success: function (response) {
                // Update the table and pagination HTML with the response
                $('#data-table').html($(response.table).find('#data-table').html());
                $('.pagination').html($(response.table).find('.pagination').html());

                // Rebind sorting indicators after AJAX update
                updateSortingIndicators();
            }
        });
    }

    // Initialize sorting indicators on page load
    updateSortingIndicators();
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


       // function confirmDelete(recnum) {
       //     let url = `/recnum/delete/${recnum}`;
       //     document.getElementById('deleteForm').action = url;
       //     new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
       // }

    </script>
@endsection
