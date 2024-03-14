<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    public function index(){

        $todo = Todo::all();
        return view('index')->with('todos', $todo);
    
    }

    public function create(){
        return view('create');
    }

    public function details(Todo $todo){

        return view('details')->with('todos', $todo);
    
    }
    
    public function edit(Todo $todo){
    
        return view('edit')->with('todos', $todo);
    
    }
    public function update(Request $request, Todo $todo){

        $attributes = $request->validate([
            'name' => ['required'],
            'description' => ['required']
        ]);
    
        $todo->update($attributes);
    
        session()->flash('success', 'Todo updated successfully');
    
        return redirect('/');
    }
    

    public function delete(Todo $todo){

        $todo->delete();

        return redirect('/');
    
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([  
                'name' => ['required'],
                'description' => ['required']
            ]);
 
        $todo = new Todo();
        $todo->name = $attributes['name'];
        $todo->description = $attributes['description'];
        $todo->save();
    
        session()->flash('success', 'Todo created successfully');
    
        return redirect('/');
    }

}
