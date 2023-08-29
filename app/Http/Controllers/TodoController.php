<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $Todos = Todo::latest()->get();

        $Pendings = Todo::where('is_completed', false)->latest()->get();
        $Completeds = Todo::where('is_completed', true)->latest()->get();

        return view('index', compact('Pendings','Completeds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Todo  = new Todo();
        $Todo->task = $request->task;
        $Todo->save();
        return  redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Todo = Todo::find($id);
        return view('index', compact('Todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Pendings = Todo::where('is_completed', false)->latest()->get();
        $Completeds = Todo::where('is_completed', true)->latest()->get();
        $EditTodo = Todo::find($id);
        return view('index', compact('Pendings', 'Completeds', 'EditTodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Todo = Todo::find($id);

        try {
            $Todo->task = $request->task;
            $Todo->save();
            return redirect('/');
        } catch (\Throwable $th) {
            return response('500'. $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Todo::find($id)){
            Todo::destroy($id);
            return redirect('/')->with("Item deleted successfully");
        }
        return redirect('/')->with('Item not found');
    }

    public function done(string $id)
    {
       $Todo = Todo::find($id);
       $Todo->is_completed = true;

       $Todo->save();
       return redirect('/');
    }


    public function undo(string $id)
    {
       $Todo = Todo::find($id);
       $Todo->is_completed = false;

       $Todo->save();
       return redirect('/');
    }

}
