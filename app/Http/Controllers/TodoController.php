<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Validator;

class TodoController extends Controller
{
    //

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'detail' => 'required',

        ]);



        $todo = Todo::create($validatedData);

        return response(['todo' => $todo]);
    }

    public function index()
    {
        return Todo::all();
    }

    public function show($id)
    {
        return Todo::find($id);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::findOrfail($id);
        $todo->update($request->all());

        return $todo;
    }

    public function delete(Request $request, $id)
    {
        $todo = Todo::findOrfail($id);
        $todo->delete();

        return 204;
    }
}
