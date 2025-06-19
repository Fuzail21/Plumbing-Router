<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoughSuper;
use App\Models\FinishSuper;
use App\Models\Engineer;
use App\Models\ProjectActManager;

class SupervisorController extends Controller
{
    public function showAddPage()
    {
        $roughSuper = RoughSuper::pluck('name');
        $finishSuper = FinishSuper::pluck('name');
        $engineer = Engineer::pluck('name');
        $pActManager = ProjectActManager::pluck('name');

        return view('admin.supervisor_add', compact('roughSuper', 'finishSuper', 'engineer', 'pActManager'));
    }

    /**
     * Store data in appropriate model/table
     */
    public function store(Request $request, $model)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $modelMap = [
            'RoughSuper' => RoughSuper::class,
            'FinishSuper' => FinishSuper::class,
            'Engineer' => Engineer::class,
            'ProjectActManager' => ProjectActManager::class,
        ];

        if (!array_key_exists($model, $modelMap)) {
            abort(404, 'Model not found');
        }

        $class = $modelMap[$model];
        $name = trim($request->name);

        // Avoid inserting duplicates like "  Seth" and "Seth"
        $class::firstOrCreate(['name' => $name]);

        return redirect()->back()->with('success', "$model added successfully.");
    }
}
