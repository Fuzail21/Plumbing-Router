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


    <form style="max-width: 100%; margin: auto; text-align: center; background-color: #FFFFFF; padding: 2%; border: 1px solid #ddd; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Job Type</label>
                <select name="jobType" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
                    <option {{ request('jobType') == 'both' ? 'selected' : '' }} value="both">COM & SFH</option>
                    <option {{ request('jobType') == 'COM' ? 'selected' : '' }} value="COM">COM</option>
                    <option {{ request('jobType') == 'SFH' ? 'selected' : '' }} value="SFH">SFH</option>
                </select>
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Job Number</label>
                <input type="text" value="{{ request('jobNumber') }}" name="jobNumber" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Material</label>
                <input type="text" value="{{ request('material') }}" name="material" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>System</label>
                <input type="text" value="{{ request('sys') }}" name="sys" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Blf-Floor</label>
                <input type="text" value="{{ request('blf_floor') }}" name="blf_floor" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Zone-Units</label>
                <input type="text" value="{{ request('units') }}" name="units" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; margin-top: 15px;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Date Needed</label>
                <input type="date" value="{{ request('dataNeeded') }}" name="dataNeeded" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Eng Date Needed</label>
                <input type="date" value="{{ request('engDateNeeded') }}" name="engDateNeeded" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Eng Complete</label>
                <input type="date" value="{{ request('engComplete') }}" name="engComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>WRHS Misc Complete</label>
                <input type="date" value="{{ request('wrhsMiscComplete') }}" name="wrhsMiscComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>FAB Complete</label>
                <input type="date" value="{{ request('fabComplete') }}" name="fabComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>FAB Misc Complete</label>
                <input type="date" value="{{ request('fabMiscComplete') }}" name="fabMiscComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        </div>


        <div style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; margin-top: 15px;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Ship Complete</label>
                <input type="date" value="{{ request('shipComplete') }}" name="shipComplete" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Rough Super</label>
                <input type="text" value="{{ request('roughSuper') }}" name="roughSuper" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>Engineer</label>
                <input type="text" value="{{ request('engineer') }}" name="engineer" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
                <label>PM Act Manager</label>
                <input type="text" value="{{ request('pmActManager') }}" name="pmActManager" style="width: 200px; padding: 5px; border: none; border-bottom: 1px solid #000;">
            </div>
        </div>

        <button type="submit" style="margin-top: 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px;">
            SEARCH
        </button>
    </form>

    <form method="POST" action="{{ route('export.excel_search') }}">
        @csrf
        <button type="submit" style="width: 100%; max-width: 200px; margin: 20px 0 20px 20px; padding: 10px 20px; background-color: navy; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s; display: block; text-align: center;">
            <i class="bi bi-filetype-xls"></i> EXPORT TO EXCEL
        </button>
    </form>

    

    <div class="app-content">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"></h3>
                @if ($search instanceof \Illuminate\Pagination\LengthAwarePaginator && $search->total() > 0)
                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-end">
                            <!-- Previous Page Link -->
                            @if ($search->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $search->previousPageUrl() }}">&laquo;</a></li>
                            @endif

                            @php
                                $start = max(1, $search->currentPage() - 2);
                                $end = min($search->lastPage(), $search->currentPage() + 2);
                            @endphp

                            <!-- First Page -->
                            @if ($start > 1)
                                <li class="page-item"><a class="page-link" href="{{ $search->url(1) }}">1</a></li>
                                @if ($start > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            <!-- Page Number Links -->
                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $search->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $search->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Last Page -->
                            @if ($end < $search->lastPage())
                                @if ($end < $search->lastPage() - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $search->url($search->lastPage()) }}">{{ $search->lastPage() }}</a></li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($search->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $search->nextPageUrl() }}">&raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                @endif

            </div> <!-- /.card-header -->
    
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
                                <th>FAB Complete</th>
                                <th>FAB Misc Complete</th>
                                <th>Ship Complete</th>
                                <th>Rough Super</th>
                                <th>Finish Super</th>
                                <th>Engineer</th>
                                <th>PM/Act Manager</th>
                                <th>WRHS to FAB</th>
                                <th>Notes</th>
                                <th>Action</th>
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
                                        <td>{{ (int) $search->jobId - (int) $search->sys - (int) $search->dx }}</td> <!-- Casting to integers to ensure proper subtraction -->
                                        <td>{{ $search->dateNeeded }}</td>
                                        <td>{{ $search->engNeeded }}</td>
                                        <td>{{ $search->engComplete }}</td>
                                        <td>{{ $search->prwr }}</td>
                                        <td>{{ $search->fabwr }}</td>
                                        <td>{{ $search->fabmisc }}</td>
                                        <td>{{ $search->shipComplete }}</td>
                                        <td>{{ $search->roughSuper }}</td>
                                        <td>{{ $search->finishSuper }}</td>
                                        <td>{{ $search->engineer }}</td>
                                        <td>{{ $search->pActManager }}</td>
                                        <td>{{ $search->wrhs2_feb }}</td>
                                        <td>{{ $search->notes }}</td>
                                        <td>
                                            <a href="{{ route('form.edit', ['recnum' => $search->recnum]) }}" class="text-success">
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
        </div>
    </div>
    

    <!-- Floating Button -->
    <a href="{{ route('form.add') }}" class="floating-btn">
        <i class="bi bi-plus"></i>
    </a>

@endsection
