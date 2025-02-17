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
                        @if ($comEng->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="{{ $comEng->currentPage() - 1 }}" href="{{ $comEng->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @php
                        $start = max(1, $comEng->currentPage() - 2);
                        $end = min($comEng->lastPage(), $comEng->currentPage() + 2);
                    @endphp

                    <!-- First Page -->
                    @if ($start > 1)
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="1" href="{{ $comEng->url(1) }}">1</a></li>
                        @if ($start > 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @endif

                    <!-- Page Number Links -->
                    @for ($page = $start; $page <= $end; $page++)
                        <li class="page-item {{ $page == $comEng->currentPage() ? 'active' : '' }}">
                            <a class="page-link page-link-ajax" data-page="{{ $page }}" href="{{ $comEng->url($page) }}">{{ $page }}</a>
                        </li>
                    @endfor

                    <!-- Last Page -->
                    @if ($end < $comEng->lastPage())
                        @if ($end < $comEng->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="{{ $comEng->lastPage() }}" href="{{ $comEng->url($comEng->lastPage()) }}">{{ $comEng->lastPage() }}</a></li>
                    @endif

                    <!-- Next Page Link -->
                    @if ($comEng->hasMorePages())
                        <li class="page-item"><a class="page-link page-link-ajax" data-page="{{ $comEng->currentPage() + 1 }}" href="{{ $comEng->nextPageUrl() }}">&raquo;</a></li>
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
                                <th><a href="#" class="sort" data-column="j.jobType" style="color: inherit; text-decoration: none;">Job Type</a></th>
                                <th><a href="#" class="sort" data-column="j.jobId" style="color: inherit; text-decoration: none;">Job #</a></th>
                                <th><a href="#" class="sort" data-column="j.descript" style="color: inherit; text-decoration: none;">Description</a></th>
                                <th><a href="#" class="sort" data-column="j.phase" style="color: inherit; text-decoration: none;">Phase</a></th>
                                <th><a href="#" class="sort" data-column="j.units" style="color: inherit; text-decoration: none;">Units</a></th>
                                <th><a href="#" class="sort" data-column="j.sys" style="color: inherit; text-decoration: none;">System</a></th>
                                <th><a href="#" class="sort" data-column="j.bldFloor" style="color: inherit; text-decoration: none;">Bld - Floor</a></th>
                                <th>Job # - System - Location</th>
                                <th><a href="#" class="sort" data-column="s.engComplete" style="color: inherit; text-decoration: none;">Date Needed</a></th>
                                <th><a href="#" class="sort" data-column="j.jobType" style="color: inherit; text-decoration: none;">ENG Complete</th>
                                <th><a href="#" class="sort" data-column="j.roughSuper" style="color: inherit; text-decoration: none;">Rough Super</a></th>
                                <th><a href="#" class="sort" data-column="j.engineer" style="color: inherit; text-decoration: none;">Engineer</a></th>
                                <th><a href="#" class="sort" data-column="s.pActManager" style="color: inherit; text-decoration: none;">PM/Act Manager</a></th>
                                <th><a href="#" class="sort" data-column="s.notes" style="color: inherit; text-decoration: none;">Notes</a></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comEng as $COM)
                                <tr class="align-middle">
                                    <td>{{ $COM->jobType }}</td>
                                    <td>{{ $COM->jobId }}</td>
                                    <td>{{ $COM->descript }}</td>
                                    <td>{{ $COM->phase }}</td>
                                    <td>{{ $COM->units }}</td>
                                    <td>{{ $COM->sys }}</td>
                                    <td>{{ $COM->bldFloor }}</td>
                                    <td>{{ (int) $COM->jobId - (int) $COM->sys - (int) $COM->dx }}</td>
                                    <td>{{ $COM->dateNeeded }}</td>
                                    <td>{{ $COM->engComplete }}</td>
                                    <td>{{ $COM->roughSuper }}</td>
                                    <td>{{ $COM->engineer }}</td>
                                    <td>{{ $COM->pActManager }}</td>
                                    <td>{{ $COM->notes }}</td>
                                    <td>
                                        <a href="{{ route('form.edit', ['recnum' => $COM->recnum]) }}" class="text-success">
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



@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Retrieve current sorting settings from session (or defaults)
            let currentColumn = "{{ session('data_sort_column_com', 'j.recnum') }}";
            let currentOrder = "{{ session('data_sort_direction_com', 'desc') }}";

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
                    url: "{{ route('com_eng') }}",
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

    </script>
@endsection
