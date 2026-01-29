<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Http\Requests\CrudRequest;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function __construct()
    {
        // Ensure user is authenticated
        $this->middleware('auth');
    }

    // List all records
    public function index()
    {
        $this->authorize('viewAny', Crud::class);

        $cruds = Crud::latest()->paginate(5);
        return view('crud.index', compact('cruds'));
    }

    // Show create form
    public function create()
    {
        $this->authorize('create', Crud::class);
        return view('crud.add');
    }

    // Store new record
    public function store(CrudRequest $request)
    {
        $this->authorize('create', Crud::class);

        try {
            Crud::create($request->validated());
            return redirect()->route('crud.index')->with('success','Record Successfully Added!');
        } catch (\Exception $e) {
            \Log::error('Crud Store Error: '.$e->getMessage());
            return redirect()->back()->with('error','Something went wrong while adding record!');
        }
    }

    // Show single record
    public function show(Crud $crud)
    {
        $this->authorize('view', $crud);
        return view('crud.show', compact('crud'));
    }

    // Show edit form
    public function edit(Crud $crud)
    {
        $this->authorize('update', $crud);
        return view('crud.add', compact('crud'));
    }

    // Update record
    public function update(CrudRequest $request, Crud $crud)
    {
        $this->authorize('update', $crud);

        try {
            $crud->update($request->validated());
            return redirect()->route('crud.index')->with('success','Record Successfully Updated!');
        } catch (\Exception $e) {
            \Log::error('Crud Update Error: '.$e->getMessage());
            return redirect()->back()->with('error','Something went wrong while updating record!');
        }
    }

    // Delete record
    public function destroy(Crud $crud)
    {
        $this->authorize('delete', $crud);

        try {
            $crud->delete();
            return redirect()->route('crud.index')->with('success','Record Successfully Deleted!');
        } catch (\Exception $e) {
            \Log::error('Crud Delete Error: '.$e->getMessage());
            return redirect()->back()->with('error','Something went wrong while deleting record!');
        }
    }
}
