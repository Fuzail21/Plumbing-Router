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
                            <th><a href="#" class="sort" data-column="bldFloor" data-order="asc" style="color: inherit; text-decoration: none;">Bid - Floor</a></th>
                            <th><a href="#" class="sort" data-column="zoneUnit" data-order="asc" style="color: inherit; text-decoration: none;">Zone - Unit</a></th>
                            <th><a href="#" class="sort" data-column="dx" data-order="asc" style="color: inherit; text-decoration: none;">D-X</a></th>
                            <th>Job # - System - Location</th>
                            <th><a href="#" class="sort" data-column="dateNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Date Needed</a></th>
                            <th><a href="#" class="sort" data-column="old_dateNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Old Date Needed</a></th>
                            <th><a href="#" class="sort" data-column="engNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Eng Date Needed</a></th>
                            <th><a href="#" class="sort" data-column="old_engNeeded" data-order="asc" style="color: inherit; text-decoration: none;">Old Eng Date Needed</a></th>

                            <th><a href="#" class="sort" data-column="engComplete" data-order="asc" style="color: inherit; text-decoration: none;">ENG Complete</a></th>
                            <th><a href="#" class="sort" data-column="prwr" data-order="asc" style="color: inherit; text-decoration: none;">WRHS Misc Complete</a></th>
                            <th><a href="#" class="sort" data-column="fabwr" data-order="asc" style="color: inherit; text-decoration: none;">FAB Complete</a></th>
                            <th><a href="#" class="sort" data-column="fabmisc" data-order="asc" style="color: inherit; text-decoration: none;">FAB Misc Complete</a></th>
                            <th><a href="#" class="sort" data-column="shipComplete" data-order="asc" style="color: inherit; text-decoration: none;">Ship Complete</a></th>
                            <th><a href="#" class="sort" data-column="roughSuper" data-order="asc" style="color: inherit; text-decoration: none;">Rough Super</a></th>
                            <th><a href="#" class="sort" data-column="finishSuper" data-order="asc" style="color: inherit; text-decoration: none;">Finish Super</a></th>
                            <th><a href="#" class="sort" data-column="engineer" data-order="asc" style="color: inherit; text-decoration: none;">Engineer</a></th>
                            <th><a href="#" class="sort" data-column="pActManager" data-order="asc" style="color: inherit; text-decoration: none;">PM/Act Manager</a></th>
                            <th><a href="#" class="sort" data-column="wrhs2_feb" data-order="asc" style="color: inherit; text-decoration: none;">WRHS to FAB</a></th>
                            <th><a href="#" class="sort" data-column="notes" data-order="asc" style="color: inherit; text-decoration: none;">Notes</a></th>
                            <th>Action</th>
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
                                    <td>{{ $row->jobId . '-' . $row->sys . '-' . $row->dx }}</td> 
                                    <td>{{ $row->dateNeeded }}</td>
                                    <td>{{ $row->old_dateNeeded }}</td>
                                    <td>{{ $row->engNeeded }}</td>
                                    <td>{{ $row->old_engNeeded }}</td>
                                    <td>{{ $row->engComplete }}</td>
                                    <td>{{ $row->prwr }}</td>
                                    <td>{{ $row->fabwr }}</td>
                                    <td>{{ $row->fabmisc }}</td>
                                    <td>{{ $row->shipComplete }}</td>
                                    <td>{{ $row->roughSuper }}</td>
                                    <td>{{ $row->finishSuper }}</td>
                                    <td>{{ $row->engineer }}</td>
                                    <td>{{ $row->pActManager }}</td>
                                    <td>{{ $row->wrhs2_feb }}</td>
                                    <td>{{ $row->notes }}</td>
                                    <td>
                                        <a href="{{ route('form.edit', ['recnum' => $row->recnum]) }}" class="text-success">
                                            <i class="bi bi-pencil"></i>
                                        </a>
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
    <a href="{{ route('form.add') }}" class="floating-btn">
        <i class="bi bi-plus"></i>
    </a>

@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.sort').on('click', function (e) {
                e.preventDefault();
            
                let column = $(this).data('column');
                let order = $(this).data('order');
                let newOrder = order === 'asc' ? 'desc' : 'asc';
            
                $.ajax({
                    url: "{{ route('dashboard') }}",
                    type: "GET",
                    data: { column: column, order: order },
                    success: function (response) {
                        $('#jobs-table').html($(response.table).find('#jobs-table').html());
                        $('.sort[data-column="' + column + '"]').data('order', newOrder);
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            let tableContainer = document.querySelector(".table-responsive");
            let floatingScrollbar = document.querySelector(".floating-scrollbar");
            let scrollbarContent = floatingScrollbar.querySelector("div");

            // Set width of floating scrollbar to match the table
            scrollbarContent.style.width = tableContainer.scrollWidth + "px";

            // Sync scrolling
            floatingScrollbar.addEventListener("scroll", function () {
                tableContainer.scrollLeft = floatingScrollbar.scrollLeft;
            });
        
            tableContainer.addEventListener("scroll", function () {
                floatingScrollbar.scrollLeft = tableContainer.scrollLeft;
            });
        });



    </script>
@endsection