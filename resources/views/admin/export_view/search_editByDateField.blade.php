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
                <table id="searchData" class="table table-striped">
                    <thead>
                        <tr>
                            <!-- Column headers here -->
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
                                <td colspan="24" class="no-records">
                                    No records found. Please enter search criteria.
                                </td>
                            </tr>
                        @else
                            @foreach($searchResults as $search)
                                <tr>
                                    <!-- Row data here -->
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
                                    <td>{{ (int) $search->jobId - (int) $search->sys - (int) $search->dx }}</td>
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
            </div>
        </div>
    </div>
</div>

<!-- Include SheetJS and FileSaver.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>
function downloadSearchDataCSV() {
    var table = document.getElementById("searchData");
    var csv = [];

    var rows = table.querySelectorAll("tr");
    rows.forEach(function (row) {
        var rowData = [];
        var cells = row.querySelectorAll("td, th");
        cells.forEach(function (cell) {
            rowData.push(cell.textContent.trim());
        });
        csv.push(rowData.join(","));
    });

    var csvContent = csv.join("\n");
    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8' });
    saveAs(blob, "SearchDataByDateFields.csv");
}
</script>

<style>
/* Responsive styles for the button */
.export-btn {
    width: 100%;
    max-width: 200px;
    margin: 20px 0 20px 20px;
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

/* Responsive styles for the table */
.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 5px;
    border: 1px solid #000;
    text-align: center;
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
