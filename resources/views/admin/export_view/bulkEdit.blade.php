<style>
    #jobTable {
        border-collapse: collapse;
        width: 100%;
    }

    #jobTable th, #jobTable td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    #jobTable thead {
        background-color: #f2f2f2;
    }

    /* Responsive styles for the button */
    .export-btn {
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

    @media (max-width: 768px) {
        .export-btn {
            max-width: 100%;
        }
    }

    /* Responsive table */
    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        border: 1px solid #000;
        text-align: left;
    }

    .no-records {
        text-align: center;
        padding: 20px;
    }

    @media (max-width: 768px) {
        th, td {
            font-size: 12px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<!-- Export to Excel Button -->
<button type="submit" onclick="downloadSearchDataCSV()" class="export-btn">
    <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
</button>

<div class="app-content">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title"></h3>
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
                                <td colspan="25" class="no-records">No records found. Please enter search criteria.</td>
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
    </div>
</div>

<!-- Include SheetJS from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<!-- Include FileSaver.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>
function downloadSearchDataCSV() {
    // Get the table element by ID
    var table = document.getElementById("jobTable");

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
    saveAs(blob, "Bulk_Data.csv");
}
</script>
