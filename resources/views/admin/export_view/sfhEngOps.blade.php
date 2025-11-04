<style>
    #sfhEng {
        border-collapse: collapse;
        width: 100%;
    }

    #sfhEng th, #sfhEng td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        white-space: nowrap; /* Prevent text wrapping */
    }

    #sfhEng thead {
        background-color: #f2f2f2;
    }

    .table-responsive {
        overflow-x: auto; /* Enable horizontal scrolling */
        width: 100%;
    }

    /* Responsive adjustments */
    @media screen and (max-width: 768px) {
        button {
            width: 100%;
            max-width: none;
        }

        .card-header h3 {
            font-size: 1.2rem;
        }

        #sfhEng th, #sfhEng td {
            font-size: 14px; /* Reduce font size for smaller screens */
            padding: 6px;
        }
    }
</style>

<button type="submit" onclick="downloadSearchDataCSV()" 
    style="width: 100%; max-width: 200px; margin: 20px 0; padding: 10px 20px; background-color: navy; 
    color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;">
    <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
</button>

<div class="app-content">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">SFH OPS Data</h3>
        </div> 

        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="sfhEng" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Job #</th>
                            <th>Description</th>
                            <th>Phase</th>
                            <th>Units</th>
                            <th>System</th>
                            <th>BLDG Floor</th>
                            <th>Date Needed</th>
                            <th>ENG Complete</th>
                            <th>Old Date Needed</th>
                            <th>Rough Super</th>
                            <th>Engineer</th>
                            <th>PM/Act Manager</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($sfhEng->isEmpty())
                            <tr>
                                <td colspan="15" style="text-align: center;">
                                    No records found. Please enter search criteria.
                                </td>
                            </tr>
                        @else
                            @foreach($sfhEng as $SFH)
                                <tr class="align-middle">
                                    <td>{{ $SFH->jobId }}</td>
                                    <td>{{ $SFH->descript }}</td>
                                    <td>{{ $SFH->phase }}</td>
                                    <td>{{ $SFH->units }}</td>
                                    <td>{{ $SFH->sys }}</td>
                                    <td>{{ $SFH->bldFloor }}</td>
                                    <td>{{ $SFH->dateNeeded ? \Carbon\Carbon::parse($SFH->dateNeeded)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $SFH->engComplete ? \Carbon\Carbon::parse($SFH->engComplete)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $SFH->old_dateNeeded ? \Carbon\Carbon::parse($SFH->old_dateNeeded)->format('m / d / Y') : '' }}</td>
                                    <td>{{ $SFH->roughSuper }}</td>
                                    <td>{{ $SFH->engineer }}</td>
                                    <td>{{ $SFH->pActManager }}</td>
                                    <td>{{ $SFH->notes }}</td>            
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>              
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function downloadSearchDataCSV() {
    var table = document.getElementById("sfhEng");
    var csv = [];
    var rows = table.querySelectorAll("tr");

    rows.forEach(function (row) {
        var rowData = [];
        var cells = row.querySelectorAll("td, th");
        cells.forEach(function (cell) {
            // Escape quotes and wrap each cell in double quotes
            var text = cell.textContent.replace(/"/g, '""').trim();
            rowData.push('"' + text + '"');
        });
        csv.push(rowData.join(","));
    });

    // Add UTF-8 BOM for proper Excel compatibility
    var csvContent = "\uFEFF" + csv.join("\n");

    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    saveAs(blob, "SFH_Eng_OPS.csv");
}
</script>
