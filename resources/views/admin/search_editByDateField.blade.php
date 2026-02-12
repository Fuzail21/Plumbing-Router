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
            border-radius: 50%; 
            width: 55px;
            height: 55px;
            font-size: 32px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none; /* Remove underline */
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


    <form method="GET" action="{{ route('search_editBy_dateField') }}" style="max-width: 100%; margin-left: auto; margin-right: auto; margin-top: 4%; margin-bottom: 4%; text-align: center; background-color: #FFFFFF; padding: 2%; border: 1px solid #ddd; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">

        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; margin-top: 15px;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Date Type</label>
                <select name="dateType" required style="width: 300px; padding: 5px; border: none; border-bottom: 1px solid #000;">
                    <option value="workDays" {{ request('dateType') == 'workDays' ? 'selected' : '' }}>Work Days</option>
                    <option value="dateNeeded" {{ request('dateType') == 'dateNeeded' ? 'selected' : '' }}>Date Needed</option>
                    <option value="engComplete" {{ request('dateType') == 'engComplete' ? 'selected' : '' }}>Eng Complete</option>
                    <option value="fabwr" {{ request('dateType') == 'fabwr' ? 'selected' : '' }}>FAB Complete</option>
                    <option value="engNeeded" {{ request('dateType') == 'engNeeded' ? 'selected' : '' }}>Engineering Date Needed</option>
                </select>
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>From:</label>
                <input type="date" name="from" value="{{ request('from') }}" style="width: 300px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>To:</label>
                <input type="date" name="to" value="{{ request('to') }}" style="width: 300px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        </div>

        <button type="submit" style="margin-top: 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px;">
            SEARCH
        </button>
    </form>



    <form method="POST" action="{{ route('export.excel_search-editBy-dateFeild') }}">
        @csrf
        <button type="submit" style="width: 100%; max-width: 200px; margin: 20px 0 20px 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s; display: block; text-align: center;">
            <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
        </button>
    </form>
    

    

    <div class="app-content">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"></h3>
                @if ($searchResults instanceof \Illuminate\Pagination\LengthAwarePaginator && $searchResults->total() > 0)
                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-end">
                            <!-- Previous Page Link -->
                            @if ($searchResults->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $searchResults->previousPageUrl() }}">&laquo;</a></li>
                            @endif

                            @php
                                $start = max(1, $searchResults->currentPage() - 2);
                                $end = min($searchResults->lastPage(), $searchResults->currentPage() + 2);
                            @endphp

                            <!-- First Page -->
                            @if ($start > 1)
                                <li class="page-item"><a class="page-link" href="{{ $searchResults->url(1) }}">1</a></li>
                                @if ($start > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            <!-- Page Number Links -->
                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $searchResults->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $searchResults->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Last Page -->
                            @if ($end < $searchResults->lastPage())
                                @if ($end < $searchResults->lastPage() - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $searchResults->url($searchResults->lastPage()) }}">{{ $searchResults->lastPage() }}</a></li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($searchResults->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $searchResults->nextPageUrl() }}">&raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                @endif

            </div> 
    
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
                                <!-- <th>WRHS to FAB</th> -->
                                <th>FAB Misc Complete</th>
                                <th>FAB Complete</th>
                                <th>Ship Complete</th>
                                <th>Rough Super</th>
                                <th>Finish Super</th>
                                <th>Engineer</th>
                                <th>PM/Act Manager</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($searchResults->isEmpty())
                                <tr>
                                    <td colspan="27" style="text-align: center;">No records found. Please enter search criteria.</td>
                                </tr>
                            @else
                                @foreach($searchResults as $search)
                                    <tr class="align-middle">
                                        <td>{{ $search->jobType }}</td>
                                        <td>{{ $search->jobId }}</td>
                                        <td>{{ $search->descript }}</td>
                                        <td>{{ $search->phase }}</td>
                                        <td>{{ $search->units }}</td>
                                        <td>{{ $search->material }}</td>
                                        <td>{{ $search->sys }}</td>
                                        <td>{{ $search->bldFloor }}</td>
                                        <td>{{ $search->zoneUnit }}</td>
                                        <td>{{ $search->dx }}</td>
                                        <td>{{ $search->jobId }} - {{ $search->sys }} - {{ $search->bldFloor }} - {{ $search->zoneUnit }} - {{ $search->dx }}</td>
                                        <td>{{ $search->dateNeeded ? \Carbon\Carbon::parse($search->dateNeeded)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->old_dateNeeded ? \Carbon\Carbon::parse($search->old_dateNeeded)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->engNeeded ? \Carbon\Carbon::parse($search->engNeeded)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->old_engNeeded ? \Carbon\Carbon::parse($search->old_engNeeded)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->engComplete ? \Carbon\Carbon::parse($search->engComplete)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->prwr }}</td>
                                        {{-- <td>{{ $search->wrhs2_feb }}</td> --}}
                                        <td>{{ $search->fabmisc }}</td>
                                        <td>{{ $search->fabwr ? \Carbon\Carbon::parse($search->fabwr)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->shipComplete ? \Carbon\Carbon::parse($search->shipComplete)->format('m / d / Y') : '' }}</td>
                                        <td>{{ $search->roughSuper }}</td>
                                        <td>{{ $search->finishSuper }}</td>
                                        <td>{{ $search->engineer }}</td>
                                        <td>{{ $search->pActManager }}</td>
                                        <td>{{ $search->notes }}</td>
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
            const exportForm = document.getElementById('exportForm');
            const dataAllInput = document.getElementById('dataAll');

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(searchForm);
                const searchParams = new URLSearchParams(formData).toString(); // Convert FormData to URLSearchParams
                fetchData(`/reports-data?${searchParams}`);
            });

            function fetchData(url) {
                fetch(url, {
                    method: 'GET', // Use GET method for AJAX request
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response:', data); // Log the response for debugging


                      // Store the 'all' variable in the hidden input field
                        if (data.all) {
                            dataAllInput.value = JSON.stringify(data.all);
                        }


                    // Clear existing table rows
                    tableBody.innerHTML = '';

                    // Check if data is available
                    if (data && data.paginated && Array.isArray(data.paginated.data)) {
                        data.paginated.data.forEach(record => {
                            const row = document.createElement('tr');
                            row.classList.add('text-xs'); // Add the text-xs class to the row
                            row.innerHTML = `
                                <td>${record.boxName ?? ''}</td>
                                <td>${record.pkgID ?? ''}</td>
                                <td>${record.pkgName ?? ''}</td>
                                <td>${record.pm ?? ''}</td>
                                <td>${record.purchasingAgent ?? ''}</td>
                                <td>${record.dateIn ?? ''}</td>
                                <td>${record.expectedDateOut ?? ''}</td>
                                <td>${record.dateOut ?? ''}</td>
                                <td>${record.deliveryLocation ?? ''}</td>
                                <td>${record.removingDriver ?? ''}</td>
                                <td>${record.removingNote ?? ''}</td>
                                <td>${record.jobNumber ?? ''}</td>
                                <td>${record.dateIn ?? ''}</td>
                                <td>${record.materialType ?? ''}</td>
                                <td>${record.materialDescription ?? ''}</td>
                                <td>${record.numberOfBundles ?? ''}</td>
                                <td>${record.modifiedNumOfBundles ?? ''}</td>
                                <td>${record.modifiedDate ?? ''}</td>
                                <td>${record.modifiedBy ?? ''}</td>
                                <td>${record.truckNumber ?? ''}</td>
                                <td>${record.packetDriver ?? ''}</td>
                                <td>${record.packetTruckNumber ?? ''}</td>
                                <td>${record.packetLocation ?? ''}</td>
                            `;
                            tableBody.appendChild(row);
                        });

                        // Display pagination links
                        paginationContainer.innerHTML = ''; // Clear previous pagination links
                        data.paginated.links.forEach(link => {
                            if (link.label) {
                                const linkElement = document.createElement('a');
                                linkElement.href = link.url || '#';
                                linkElement.innerHTML = link.label.includes('&laquo;') || link.label.includes('&raquo;') ? link.label : link.label;
                                linkElement.classList.add('pagination-link');
                                if (link.active) {
                                    linkElement.classList.add('active'); // Highlight the active link
                                }
                                paginationContainer.appendChild(linkElement);
                            } else {
                                console.error('Label is undefined for one of the links:', link);
                            }
                        });

                        // Add event listeners to pagination links
                        const paginationLinks = document.querySelectorAll('.pagination-link');
                        paginationLinks.forEach(link => {
                            link.addEventListener('click', function(e) {
                                e.preventDefault();
                                const url = this.href;
                                fetchData(url);
                            });
                        });

                    } else {
                        console.error('Invalid data format:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
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