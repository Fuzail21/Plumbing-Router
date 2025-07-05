<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobInformation;
use App\Models\JobStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\RoughSuper;
use App\Models\FinishSuper;
use App\Models\Engineer;
use App\Models\ProjectActManager;

class JobInformations extends Controller
{
    public function add(){
        $query = DB::table('job_information as j')
        ->join('job_status as s', 'j.recnum', '=', 's.recnum')
        ->select('j.*', 's.*')
        ->get();

        // $roughSuper = $query->pluck('roughSuper')->unique()->reject(function ($value) {
        //     return empty($value);
        // })->values();
        
        // $finishSuper = $query->pluck('finishSuper')->unique()->reject(function ($value) {
        //     return empty($value);
        // })->values();
        
        // $engineer = $query->pluck('engineer')->unique()->reject(function ($value) {
        //     return empty($value);
        // })->values();
        
        // $pActManager = $query->pluck('pActManager')->unique()->reject(function ($value) {
        //     return empty($value);
        // })->values();


        $roughSuper = RoughSuper::select('name')->get()->filter(function ($item) {
            return !preg_match('/[^a-zA-Z0-9\s]/', $item->name); // skip if name has special characters
        })->pluck('name');
        $finishSuper  = FinishSuper::pluck('name');
        $engineer     = Engineer::pluck('name');
        $pActManager = ProjectActManager::select('name')->get()->filter(function ($item) {
            return !preg_match('/[^a-zA-Z0-9\s]/', $item->name);
        })->pluck('name');
        

        $data = compact('roughSuper', 'finishSuper', 'engineer', 'pActManager');
        return view('admin.add')->with($data);
    }

    public function edit($recnum){
        $record = DB::table('job_information as j')
        ->join('job_status as s', 'j.recnum', '=', 's.recnum')
        ->where('j.recnum', '=', $recnum)
        ->select('j.*', 's.*')
        ->first();

        return view('admin.update', compact('record'));
    }

    public function insert(Request $request){
        DB::beginTransaction();
        try {
            // Get the last recnum and increment for each new record separately
            $lastRecnum = JobInformation::max('recnum') ?? 0;
    
            $recordsToInsert = [];
    
            // Loop through submitted values
            foreach ($request->material as $index => $material) {
                // Extract all values for this index
                $system = $request->system[$index] ?? null;
                $bldFloor = $request->bldFloor[$index] ?? null;
                $zoneUnit = $request->zoneUnit[$index] ?? null;
                $dx = $request->dx[$index] ?? null;
                $dateNeeded = $request->dateNeeded[$index] ?? null;
                $engNeeded = $request->engNeeded[$index] ?? null;
    
                // Check if at least one field has a value
                if (!empty($material) || !empty($system) || !empty($bldFloor) || !empty($zoneUnit) || !empty($dx) || !empty($dateNeeded) || !empty($engNeeded)) {
                    // Increment the recnum for each record
                    $newRecnum = $lastRecnum + 1;
                    $lastRecnum = $newRecnum; // Update lastRecnum for the next iteration
    
                    // Save job information
                    $job = JobInformation::create([
                        'recnum' => $newRecnum,
                        'jobType' => $request->jobType,
                        'jobId' => $request->jobNum,
                        'descript' => $request->description,
                        'phase' => $request->phase,
                        'units' => $request->units,
                        'material' => $material,
                        'sys' => $system,
                        'bldFloor' => $bldFloor,
                        'zoneUnit' => $zoneUnit,
                        'dx' => $dx,
                        'roughSuper' => $request->roughSuper,
                        'finishSuper' => $request->finishSuper,
                        'engineer' => $request->engineer,
                    ]);
    
                    // Save job status
                    JobStatus::create([
                        'jobId' => $job->jobId,
                        'recnum' => $newRecnum,
                        'dateNeeded' => $dateNeeded,
                        'engNeeded' => $engNeeded,
                        'pActManager' => $request->pmactmanager,
                    ]);
    
                    $recordsToInsert[] = $job->id; // Track inserted records
                }
            }
    
            // If no valid records were inserted, rollback
            if (empty($recordsToInsert)) {
                DB::rollBack();
                return response()->json(['error' => 'No valid records to save'], 400);
            }
    
            DB::commit();
            return redirect()->route('search')->with('success', 'Added Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to save job', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $recnum) {
        // Fetch job status using Eloquent
        $jobStatus = JobStatus::where('recnum', $recnum)->first();

        if (!$jobStatus) {
            return response()->json(['message' => 'Job status not found'], 404);
        }

        // Store old values before update
        $oldDateNeeded = $jobStatus->dateNeeded;
        $oldEngNeeded = $jobStatus->engNeeded;

        // Prepare update data for job_status
        $updateData = [];

        if ($request->filled('dateNeeded')) {
            $updateData['old_dateNeeded'] = $oldDateNeeded;
            $updateData['dateNeeded'] = $request->dateNeeded;
        }

        if ($request->filled('engNeeded')) {
            $updateData['old_engNeeded'] = $oldEngNeeded;
            $updateData['engNeeded'] = $request->engNeeded;
        }

        // Update only if there are changes
        if (!empty($updateData)) {
            $jobStatus->update($updateData);
        }

        // Update job_information table
        DB::table('job_information')
            ->where('recnum', $recnum)
            ->update([
                'jobType' => $request->jobType,
                'descript' => $request->description,
                'phase' => $request->phase,
                'units' => $request->units,
                'material' => $request->material,
                'sys' => $request->sys,
                'bldFloor' => $request->bldFloor,
                'zoneUnit' => $request->zoneUnit,
                'dx' => $request->dx,
                'roughSuper' => $request->roughSuper,
                'finishSuper' => $request->finishSuper,
                'engineer' => $request->engineer,
            ]);

        // Update job_status table with other fields
        DB::table('job_status')
            ->where('recnum', $recnum)
            ->update([
                'engComplete' => $request->engComplete,
                'prwr' => $request->wrhsMiscComplete,
                'fabwr' => $request->fabComplete,
                'shipComplete' => $request->shipComplete,
                'wrhs2_feb' => $request->wrhs2Feb,
                'notes' => $request->note,
            ]);

        return redirect()->route('search')->with('success', 'Updated Successfully.');
    }

    public function home(Request $request)
    {
        $sortColumn = $request->input('column', session('sort_column', 'j.recnum'));
        $sortDirection = $request->input('order', session('sort_direction', 'desc'));

        // Define allowed columns for sorting
        $validColumns = [
            'j.recnum', 'j.jobId', 'j.descript', 'j.phase', 'j.units', 'j.material', 
            'j.sys', 'j.bldFloor', 'j.zoneUnit', 'j.dx', 's.updated_at'
        ];
        $dateColumns = ['s.updated_at'];

        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'j.recnum';
        }

        session(['sort_column' => $sortColumn, 'sort_direction' => $sortDirection]);

        // Base query
        $query = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->select('j.*', 's.*')
            ->orderBy($sortColumn, $sortDirection);

        // Fetch data
        $jobs = $query->paginate(150);

        // Handle AJAX response
        if ($request->ajax()) {
            return response()->json([
                'table' => view('admin.dashboard', compact('jobs'))->render()

            ]);
        }

        return view('admin.dashboard', compact('jobs'));
    }

    public function data_view(Request $request) {
        // Get sorting parameters from session or request
        $sortColumn = $request->get('column', session('data_sort_column', 'j.recnum'));
        $sortDirection = $request->get('order', session('data_sort_direction', 'desc'));
    
        // Store sorting preferences in session
        session(['data_sort_column' => $sortColumn, 'data_sort_direction' => $sortDirection]);
    
        // Fetch data with sorting
        $dataView = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->select('j.*', 's.*')
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(150);
    
        // Return AJAX response for sorting and pagination
        if ($request->ajax()) {
            return response()->json([
                'table' => view('admin.data_view', compact('dataView'))->render()
            ]);
        }
    
        return view('admin.data_view', compact('dataView'));
    }    

    public function search(Request $request) {
        $query = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->select('j.*', 's.*')
            ->distinct();
    
        $isSearchApplied = false; // Flag to check if any filter is applied
    
        // Apply filters based on the form inputs
        if ($request->has('jobType') && trim($request->jobType) != '') {
            $jobType = trim($request->jobType);
            
            if ($jobType === 'both') {
                // If jobType is a space, consider both 'com' and 'sfh'
                $query->whereIn('j.jobType', ['COM', 'SFH']);
            } else {
                // Otherwise, use the provided jobType
                $query->where('j.jobType', $jobType);
            }
            $isSearchApplied = true;
        }
    
        if ($request->has('jobNumber') && trim($request->jobNumber) != '') {
            $query->where('j.jobId', 'like', '%' . trim($request->jobNumber) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('material') && trim($request->material) != '') {
            $query->where('j.material', 'like', '%' . trim($request->material) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('sys') && trim($request->sys) != '') {
            $query->where('j.sys', 'like', '%' . trim($request->sys) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('blf_floor') && trim($request->blf_floor) != '') {
            $query->where('j.bldFloor', 'like', '%' . trim($request->blf_floor) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('units') && trim($request->units) != '') {
            $query->where('j.zoneUnit', 'like', '%' . trim($request->units) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('dataNeeded') && trim($request->dataNeeded) != '') {
            $query->where('s.dateNeeded', '=', trim($request->dataNeeded));
            $isSearchApplied = true;
        }
    
        if ($request->has('engDateNeeded') && trim($request->engDateNeeded) != '') {
            $query->where('s.engNeeded', '=', trim($request->engDateNeeded));
            $isSearchApplied = true;
        }
    
        if ($request->has('engComplete') && trim($request->engComplete) != '') {
            $query->where('s.engComplete', 'like', '%' . trim($request->engComplete) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('fabMiscComplete') && trim($request->fabMiscComplete) != '') {
            $query->where('s.fabmisc', 'like', '%' . trim($request->fabMiscComplete) . '%');
            $isSearchApplied = true;
        }

        if ($request->has('wrhsMiscComplete') && trim($request->wrhsMiscComplete) != '') {
            $query->where('s.prwr', 'like', '%' . trim($request->wrhsMiscComplete) . '%');
            $isSearchApplied = true;
        }

        if ($request->has('fabComplete') && trim($request->fabComplete) != '') {
            $query->where('s.fabwr', 'like', '%' . trim($request->fabComplete) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('shipComplete') && trim($request->shipComplete) != '') {
            $query->where('s.shipComplete', 'like', '%' . trim($request->shipComplete) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('roughSuper') && trim($request->roughSuper) != '') {
            $query->where('j.roughSuper', 'like', '%' . trim($request->roughSuper) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('engineer') && trim($request->engineer) != '') {
            $query->where('j.engineer', 'like', '%' . trim($request->engineer) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('pmActManager') && trim($request->pmActManager) != '') {
            $query->where('s.pActManager', 'like', '%' . trim($request->pmActManager) . '%');
            $isSearchApplied = true;
        }
    
        // Execute query and paginate only if search filters are applied
        if ($isSearchApplied) {
            $search = (clone $query)->orderBy('j.recnum', 'desc')->paginate(20)->appends(request()->query());

            $allSearch = (clone $query)->orderBy('j.recnum', 'desc')->get();
        
            session(['search' => $allSearch]);
        
            return view('admin.search', compact('search'));
        }
        
    
        // Return empty result if no filters are applied
        return view('admin.search', ['search' => collect()]);
    }
    
    public function sfh_eng(Request $request){
        // Get sorting parameters from session or request
        $sortColumn = $request->get('column', session('data_sort_column_sfh', 'j.recnum'));
        $sortDirection = $request->get('order', session('data_sort_direction_sfh', 'desc'));

        // Store sorting preferences in session
        session(['data_sort_column_sfh' => $sortColumn, 'data_sort_direction_sfh' => $sortDirection]);

        // Fetch data with sorting
        $sfhEng = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->where('j.jobType', '=', 'SFH')
            ->select('j.*', 's.*')
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(150);

        // Return AJAX response for sorting and pagination
        if ($request->ajax()) {
            return response()->json([
                'table' => view('admin.sfhEng', compact('sfhEng'))->render()
            ]);
        }

        return view('admin.sfhEng', compact('sfhEng'));
    }

    public function com_eng(Request $request){
        // Get sorting parameters from session or request
        $sortColumn = $request->get('column', session('data_sort_column_com', 'j.recnum'));
        $sortDirection = $request->get('order', session('data_sort_direction_com', 'desc'));

        // Store sorting preferences in session
        session(['data_sort_column_com' => $sortColumn, 'data_sort_direction_com' => $sortDirection]);

        // Fetch data with sorting
        $comEng = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->where('j.jobType', '=', 'COM')
            ->select('j.*', 's.*')
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(150);

        // Return AJAX response for sorting and pagination
        if ($request->ajax()) {
            return response()->json([
                'table' => view('admin.comEng', compact('comEng'))->render()
            ]);
        }

        return view('admin.comEng', compact('comEng'));
    }

    public function sfh_eng_search(Request $request) {
        $query = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->where('j.jobType', '=', 'SFH')
            ->select('j.*', 's.*')
            ->distinct();
    
        // List of searchable fields
        $filters = [
            'jobNumber'    => 'j.jobId',
            'description'  => 'j.descript',
            'phase'        => 'j.phase',
            'units'        => 'j.units',
            'sys'          => 'j.sys',
            'blf_floor'    => 'j.bldFloor',
            'dataNeeded'   => 's.dateNeeded',
            'engComplete'  => 's.engComplete',
            'roughSuper'   => 'j.roughSuper',
            'engineer'     => 'j.engineer',
            'pmActManager' => 's.pActManager',
            'wrhs2Feb'     => 's.wrhs2_feb',
        ];
    
        // Apply filters dynamically
        $searchApplied = false;
        foreach ($filters as $input => $column) {
            if ($request->filled($input)) {
                $query->where($column, 'LIKE', '%' . trim($request->input($input)) . '%');
                $searchApplied = true;
            }
        }
    
        // If search has been applied, get the results
        if ($searchApplied) {
            $sfhEngSearch = (clone $query)->orderBy('j.recnum', 'desc')->paginate(20)->appends(request()->query());
            
            $allSfhEngSearch = (clone $query)->orderBy('j.recnum', 'desc')->get();
    
            session(['sfhEngSearch' => $allSfhEngSearch]);
        
        } else {
            $sfhEngSearch = collect();
        }
        
        return view('admin.sfhEngSearch', compact('sfhEngSearch', 'searchApplied'));        
        
    }

    public function search_editBy_dateField(Request $request) {
        $query = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->select('j.recnum', 'j.jobType', 'j.*', 's.*') // Ensure ORDER BY column is included
            ->orderBy('j.recnum', 'desc'); // Apply ORDER BY
    
        // Initialize empty results
        $searchResults = collect([]);
    
        if ($request->filled('dateType') && $request->filled('from') && $request->filled('to')) {
            $column = $request->input('dateType'); 
            $from = $request->input('from');
            $to = $request->input('to');
    
            // Clone query before modifying
            $filteredQuery = clone $query;
            $filteredQuery->whereBetween("s.$column", [$from, $to]);
    

            $allSearchResults = (clone $filteredQuery)->get();

            // Paginated results with query parameters
            $searchResults = $filteredQuery->paginate(20)->appends(request()->query());
    
            // Get all results without pagination and store in session
            session(['searchResults' => $allSearchResults]);  // Store non-paginated results
    
        }
    
        return view('admin.search_editByDateField', compact('searchResults'));
    }
    
    public function bulk_edit(Request $request) {
        $query = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->select('j.*', 's.*')
            ->distinct();
    
        $isSearchApplied = false; // Flag to check if any filter is applied
    
        // Apply filters based on the form inputs
        if ($request->has('jobType') && trim($request->jobType) != '') {
            $jobType = trim($request->jobType);
            
            if ($jobType === 'both') {
                // If jobType is a space, consider both 'com' and 'sfh'
                $query->whereIn('j.jobType', ['COM', 'SFH']);
            } else {
                // Otherwise, use the provided jobType
                $query->where('j.jobType', $jobType);
            }
            $isSearchApplied = true;
        }
    
        if ($request->has('jobNumber') && trim($request->jobNumber) != '') {
            $query->where('j.jobId', 'like', '%' . trim($request->jobNumber) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('material') && trim($request->material) != '') {
            $query->where('j.material', 'like', '%' . trim($request->material) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('sys') && trim($request->sys) != '') {
            $query->where('j.sys', 'like', '%' . trim($request->sys) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('blf_floor') && trim($request->blf_floor) != '') {
            $query->where('j.bldFloor', 'like', '%' . trim($request->blf_floor) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('units') && trim($request->units) != '') {
            $query->where('j.zoneUnit', 'like', '%' . trim($request->units) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('dataNeeded') && trim($request->dataNeeded) != '') {
            $query->where('s.dateNeeded', '=', trim($request->dataNeeded));
            $isSearchApplied = true;
        }
    
        if ($request->has('engDateNeeded') && trim($request->engDateNeeded) != '') {
            $query->where('s.engNeeded', '=', trim($request->engDateNeeded));
            $isSearchApplied = true;
        }
    
        if ($request->has('engComplete') && trim($request->engComplete) != '') {
            $query->where('s.engComplete', 'like', '%' . trim($request->engComplete) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('fabMiscComplete') && trim($request->fabMiscComplete) != '') {
            $query->where('s.fabmisc', 'like', '%' . trim($request->fabMiscComplete) . '%');
            $isSearchApplied = true;
        }

        if ($request->has('wrhsMiscComplete') && trim($request->wrhsMiscComplete) != '') {
            $query->where('s.prwr', 'like', '%' . trim($request->wrhsMiscComplete) . '%');
            $isSearchApplied = true;
        }

        if ($request->has('fabComplete') && trim($request->fabComplete) != '') {
            $query->where('s.fabwr', 'like', '%' . trim($request->fabComplete) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('shipComplete') && trim($request->shipComplete) != '') {
            $query->where('s.shipComplete', 'like', '%' . trim($request->shipComplete) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('roughSuper') && trim($request->roughSuper) != '') {
            $query->where('j.roughSuper', 'like', '%' . trim($request->roughSuper) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('engineer') && trim($request->engineer) != '') {
            $query->where('j.engineer', 'like', '%' . trim($request->engineer) . '%');
            $isSearchApplied = true;
        }
    
        if ($request->has('pmActManager') && trim($request->pmActManager) != '') {
            $query->where('s.pActManager', 'like', '%' . trim($request->pmActManager) . '%');
            $isSearchApplied = true;
        }
    
        if ($isSearchApplied) {
            // Clone the query and apply pagination with query parameters
            $bulkEdit = (clone $query)->orderBy('j.recnum', 'desc')->paginate(20)->appends(request()->query());
        
            // Clone again for non-paginated results
            $allBulkEdit = (clone $query)->orderBy('j.recnum', 'desc')->get();
        
            session(['bulkEdit' => $allBulkEdit]);
        
            return view('admin.bulk_edit', compact('bulkEdit'));
        }
        
        
    
        // Return empty result if no filters are applied
        return view('admin.bulk_edit', ['bulkEdit' => collect()]);
    }

    public function updateJob(Request $request, $recnum){
        // Fetch current job status to store old values
        $jobStatus = DB::table('job_status')->where('recnum', $recnum)->first();
    
        if (!$jobStatus) {
            return response()->json(['message' => 'Job status not found'], 404);
        }
    
        // Extract valid fields while keeping "0" values
        $jobInfoData = array_filter([
            'descript' => $request->descript,
            'phase' => $request->phase,
            'units' => $request->units,
            'material' => $request->material,
            'sys' => $request->sys,
            'bldFloor' => $request->bldFloor,
            'zoneUnit' => $request->zoneUnit,
            'dx' => $request->dx,
            'roughSuper' => $request->roughSuper,
            'finishSuper' => $request->finishSuper,
            'engineer' => $request->engineer,
        ], fn($value) => $value !== null); // Keep 0 values
    
        // Prepare job status data and store old values
        $jobStatusData = array_filter([
            'dateNeeded' => $request->dateNeeded,
            'engNeeded' => $request->engNeeded,
            'engComplete' => $request->engComplete,
            'prwr' => $request->prwr,
            'fabwr' => $request->fabwr,
            'fabmisc' => $request->fabmisc,
            'shipComplete' => $request->shipComplete,
            'pActManager' => $request->pActManager,
            'wrhs2_feb' => $request->wrhs2_feb,
            'notes' => $request->notes,
        ], fn($value) => $value !== null); // Keep 0 values
    
        // Check if dateNeeded is changing and store old value
        if ($request->filled('dateNeeded') && $request->dateNeeded !== $jobStatus->dateNeeded) {
            $jobStatusData['old_dateNeeded'] = $jobStatus->dateNeeded;
        }
    
        // Check if engNeeded is changing and store old value
        if ($request->filled('engNeeded') && $request->engNeeded !== $jobStatus->engNeeded) {
            $jobStatusData['old_engNeeded'] = $jobStatus->engNeeded;
        }
    
        // Check if there's data to update
        $jobInformationUpdated = !empty($jobInfoData)
            ? DB::table('job_information')->where('recnum', $recnum)->update($jobInfoData)
            : false;
    
        $jobStatusUpdated = !empty($jobStatusData)
            ? DB::table('job_status')->where('recnum', $recnum)->update($jobStatusData)
            : false;
    
        // Check if at least one update was successful
        if ($jobInformationUpdated || $jobStatusUpdated) {
            return response()->json(['message' => 'Job updated successfully!']);
        } else {
            return response()->json(['message' => 'No changes detected or update failed.'], 400);
        }
    }


    //search_editByDateField
    public function export_excel_view_search_editBy_dateFeild(Request $request){
        $searchResults = session('searchResults', []);
        // dd($searchResults);
        return view('admin.export_view.search_editByDateField', compact('searchResults'));
    }

    //search_bulk_edit
    public function export_excel_view_bulkEdit(Request $request){
        $bulkEdit = session('bulkEdit', []);
        return view('admin.export_view.bulkEdit', compact('bulkEdit'));
    }

    //search_sfh-eng-search
    public function export_excel_view_sf_eng_search(Request $request){
        $sfhEng = session('sfhEngSearch', []);
        return view('admin.export_view.sfhEngSearch', compact('sfhEng'));
    }

    //search
    public function export_excel_view_search(Request $request){
        $search = session('search', []);
        return view('admin.export_view.search', compact('search'));
    }


    public function AdminLogout(Request $request){
        Auth::logout();
        Session::flush(); 

        return redirect('/');
    }

    public function sf_sort_filter(Request $request){
        // Get sorting parameters from session or request
        $sortColumn = $request->get('column', session('data_sort_column_sfh', 'j.recnum'));
        $sortDirection = $request->get('order', session('data_sort_direction_sfh', 'desc'));

        // Store sorting preferences in session
        session(['data_sort_column_sfh' => $sortColumn, 'data_sort_direction_sfh' => $sortDirection]);

        // Fetch data with sorting
        $sfSort = DB::table('job_information as j')
            ->join('job_status as s', 'j.recnum', '=', 's.recnum')
            ->where('j.jobType', '=', 'SFH')
            ->select('j.*', 's.*')
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(150);

        // Return AJAX response for sorting and pagination
        if ($request->ajax()) {
            return response()->json([
                'table' => view('admin.sf_sort_filter', compact('sfSort'))->render()
            ]);
        }

        return view('admin.sf_sort_filter', compact('sfSort'));
    }    

}
