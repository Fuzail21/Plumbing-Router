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
                                <th>Bid - Floor</th>
                                <th>Zone - Unit</th>
                                <th>D-X</th>
                                <th>Job # - System - Location</th>
                                <th>Date Needed</th>
                                <th>Engineering Date Needed</th>
                                <th>ENG Complete</th>
                                <th>WRHS Misc Complete</th>
                                <th>WRHS to FAB</th>
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
                                    <td colspan="24" style="text-align: center;">No records found. Please enter search criteria.</td>
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
                                        <td>{{ (int) $search->jobId - (int) $search->sys - (int) $search->dx }}</td> <!-- Casting to integers to ensure proper subtraction -->
                                        <td>{{ $search->dateNeeded }}</td>
                                        <td>{{ $search->engNeeded }}</td>
                                        <td>{{ $search->engComplete }}</td>
                                        <td>{{ $search->prwr }}</td>
                                        <td>{{ $search->wrhs2_feb }}</td>
                                        <td>{{ $search->fabmisc }}</td>
                                        <td>{{ $search->fabwr }}</td>
                                        <td>{{ $search->shipComplete }}</td>
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
</script>