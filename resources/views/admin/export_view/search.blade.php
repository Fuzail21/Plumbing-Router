<style>
    #search {
        border-collapse: collapse;
        width: 100%;
    }

    #search th, #search td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    #search thead {
        background-color: #f2f2f2;
    }

    /* Button styling */
    button[type="submit"] {
        width: 100%;
        max-width: 200px;
        margin: 20px 0;
        padding: 10px 20px;
        background-color: navy;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
        display: block;
        text-align: center;
    }

    /* Make the table responsive */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Mobile-specific styles */
    @media (max-width: 768px) {
        #search th, #search td {
            padding: 6px;
        }

        /* Reduce the font size for mobile view */
        #search th, #search td {
            font-size: 12px;
        }

        /* Stack the buttons in mobile view */
        button[type="submit"] {
            max-width: 100%;
            font-size: 14px;
        }

        /* Make the table horizontally scrollable */
        .table-responsive {
            overflow-x: scroll;
            -webkit-overflow-scrolling: touch;
        }
    }

    /* For very small screens */
    @media (max-width: 480px) {
        #search th, #search td {
            font-size: 10px;
        }

        /* Make the header font smaller */
        #search thead {
            font-size: 12px;
        }

        /* Adjust margins */
        button[type="submit"] {
            padding: 8px 16px;
        }
    }
</style>

<button type="submit" onclick="downloadSearchDataCSV()">
    <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
</button>

<div class="app-content">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title"></h3>
        </div> 

        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="search" class="table table-striped">
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
                        </tr>
                    </thead>
                    <tbody>
                        @if($search->isEmpty())
                            <tr>
                                <td colspan="25" style="text-align: center;">No records found. Please enter search criteria.</td>
                            </tr>
                        @else
                            @foreach($search as $search)
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
                                    <td>{{ $search->fabwr ? \Carbon\Carbon::parse($search->fabwr)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $search->fabmisc }}</td>
                                    <td>{{ $search->shipComplete ? \Carbon\Carbon::parse($search->shipComplete)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $search->roughSuper }}</td>
                                    <td>{{ $search->finishSuper }}</td>
                                    <td>{{ $search->engineer }}</td>
                                    <td>{{ $search->pActManager }}</td>
                                    {{-- <td>{{ $search->wrhs2_feb }}</td> --}}
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function downloadSearchDataCSV() {
    // Get the table element by ID
    var table = document.getElementById("search");

    // Initialize an empty CSV string
    var csv = [];

    // Iterate over the rows in the table
    var rows = table.querySelectorAll("tr");
    rows.forEach(function (row) {
        // Initialize an empty array for each row
        var rowData = [];

        // Iterate over the cells in the row
        var cells = row.querySelectorAll("td, th");
        cells.forEach(function (cell) {
            // Push the cell's text content into the row data array
            rowData.push(cell.textContent.trim());
        });

        // Push the row data as a comma-separated string into the CSV array
        csv.push(rowData.join(","));
    });

    // Join the CSV array into a single string with line breaks
    var csvContent = csv.join("\n");

    // Create a Blob with the CSV content and UTF-8 encoding
    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8' });

    // Save the Blob as a file using FileSaver.js
    saveAs(blob, "Search.csv");
}
</script>
