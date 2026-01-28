<style>
    #warehouse {
        border-collapse: collapse;
        width: 100%;
    }

    #warehouse th, #warehouse td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        white-space: nowrap; /* Prevent text wrapping */
    }

    #warehouse thead {
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

        #warehouse th, #warehouse td {
            font-size: 14px; /* Reduce font size for smaller screens */
            padding: 6px;
        }
    }
</style>

<button type="submit" onclick="downloadWarehouseDataCSV()" 
    style="width: 100%; max-width: 200px; margin: 20px 0; padding: 10px 20px; background-color: navy; 
    color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;">
    <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
</button>

<div class="app-content">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Warehouse</h3>
        </div> 

        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="warehouse" class="table table-striped">
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
                            <th>Fab Misc Completed</th>
                            <th>FAB Complete</th>
                            <th>Ship Complete</th>                                
                            <th>Rough-Super</th>
                            <th>Notes</th>                             
                        </tr>
                    </thead>
                    <tbody>
                        @if($warehouse->isEmpty())
                        <tr>
                            <td colspan="12" style="text-align: center;">No records found.</td>
                        </tr>
                        @else
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
    function downloadWarehouseDataCSV() {
        var table = document.getElementById("warehouse");
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
        saveAs(blob, "warehouse.csv");
    }
</script>
