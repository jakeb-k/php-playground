<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all(); 
        
        foreach($tasks as $task){
            $task->due_date = Carbon::parse($task->due_date)->format('d/m/y'); 
        }
        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task' => 'required|max:80',
            'priority' => 'required|integer|gt:0|lt:4',
            'due_date' => 'required|date'
        ]);

        $task = new Task(); 
        $task->task = $validatedData['task'];
        $task->priority = $validatedData['priority'];
        $task->due_date = $validatedData['due_date']; 
        $task->save(); 

        session()->flash('message', 'Goal was added!');

        return Inertia::location(url('/dashboard'));


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        

        return Inertia::render('Tasks/Edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     
        $validatedData = $request->validate([
            'task' => 'required|max:80',
            'priority' => 'required|integer|gt:0|lt:4',
            'due_date' => 'required:date'
        ]);

        $task = Task::find($id); 
        $task->task = $validatedData['task'];
        $task->priority = $validatedData['priority'];
        $task->due_date = $validatedData['due_date']; 
     
        $task->save(); 

        session()->flash('message', 'Goal was updated!');

        
        return Inertia::location(url('/dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id); 

        $task->delete(); 

    }
}
