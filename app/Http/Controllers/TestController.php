<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Exports\TestExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TestImport;


class TestController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Test::query();

        // 🔹 Filtering
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        // 🔹 Sorting
        $sortable = ['name', 'age', 'created_at'];
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        if (in_array($sort, $sortable)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->latest(); // default sort
        }

        // 🔹 Normal Pagination
        $tests = $query->paginate(100)->withQueryString();

        return view('test.list', compact('tests'));
    }

    // 🔹 Cursor Pagination (fast)
    public function cursorIndex(Request $request)
    {
        $query = Test::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        $tests = $query->orderBy('id')->cursorPaginate(15);

        return view('test.list', compact('tests'));
    }

    // 🔹 Chunk / Lazy Collection Example
    public function processLargeDataset()
    {
        Test::chunk(1000, function($records) {
            foreach ($records as $record) {
                // process each record
            }
        });

        // OR using lazy cursor
        foreach (Test::cursor() as $record) {
            // process each record
        }

        return "Processing done!";
    }

    public function create()
    {
        return view('test.add');
    }

  
    public function store(Request $request)
    {
        // dd($request->all());exit();
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer',
        ]);

        // Test::create([
        //     'name' => $request->name,
        //     'age'  => $request->age,
        // ]);

        $data = [
                    'name' => $request->name,
                    'age'  => $request->age,
                        // future fields yahin add hongi
                        // 'email' => $request->email ?? null,
                        // 'dob'   => $request->dob ?? null,
                ];

        Test::create($data);
        return redirect()->route('test.index')
                         ->with('success','Record added successfully');
    }

    
    public function edit(Test $test)
    {
        return view('test.add', compact('test'));
    }

    //  public function edit($id)
    // {
    //     $test = Test::findOrFail($id);
    // }

    public function update(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer',
        ]);

        $test->update([
            'name' => $request->name,
            'age'  => $request->age,
        ]);

        return redirect()->route('test.index')
                         ->with('success','Record updated successfully');
    }

  
    public function destroy(Test $test)
    {
        $test->delete();

        return redirect()->route('test.index')
                         ->with('success','Record deleted successfully');
    }

    public function export()
    {
        return Excel::download(new TestExport, 'Test.xlsx');
    }

    public function show(Test $test)
    {
        return view('test.show', compact('test'));
    }
   
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new TestImport, $request->file('file'));

        return back()->with('success', 'Test imported successfully');
    }
    
}
