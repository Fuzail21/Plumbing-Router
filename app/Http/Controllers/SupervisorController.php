<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoughSuper;
use App\Models\FinishSuper;
use App\Models\Engineer;
use App\Models\ProjectActManager;

class SupervisorController extends Controller
{
    public function showAddPage(){
        $roughSuper = RoughSuper::select('id', 'name')->paginate(10);
        $finishSuper = FinishSuper::select('id', 'name')->paginate(10);
        $engineer = Engineer::select('id', 'name')->paginate(10);
        $pActManager = ProjectActManager::select('id', 'name')->paginate(10);

        return view('admin.supervisor_add', compact('roughSuper', 'finishSuper', 'engineer', 'pActManager'));
    }

    public function store(Request $request, $model){
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

        return redirect()->back()->with('success', "$model added successfully.")->with('active_tab', $model);
    }

    public function update(Request $request, $model, $id){
        $modelClass = $this->getModelClass($model);
        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Invalid model'], 400);
        }

        $item = $modelClass::findOrFail($id);
        $item->name = $request->name;
        $item->save();

        return response()->json(['success' => true]);
    }

    public function destroy($model, $id){
        $modelClass = $this->getModelClass($model);
        if (!class_exists($modelClass)) {
            abort(404, 'Invalid model');
        }

        $modelClass::destroy($id);
        return redirect()->back()->with('success', 'Deleted successfully!')->with('active_tab', $model);;
    }

    protected function getModelClass($model){
        $map = [
            'RoughSuper' => \App\Models\RoughSuper::class,
            'FinishSuper' => \App\Models\FinishSuper::class,
            'Engineer' => \App\Models\Engineer::class,
            'ProjectActManager' => \App\Models\ProjectActManager::class,
        ];

        return $map[$model] ?? null;
    }
}
