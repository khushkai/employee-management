<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    
    public function index()
    {
       if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        } 
       $demos =Demo::latest()->paginate(5);
       return  view('demo.index',compact('demos'));
    }

 
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('demo.add');
    }

 
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'name'=>'required|string|max:225',
            'age'=>'required|integer',
        ]);
       try {
            $data = [
                'name' => $request->name,
                'age' => $request->age,
            ];
            Demo::create($data);

            return redirect()->route('demo.index')->with('success', 'Record Successfully Inserted!');
        } catch (\Exception $e) {
            // Optional: log the error
            \Log::error('Demo Store Error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong while inserting the record!');
        }
    }
    
    public function show(Demo $demo)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('demo.show',compact('demo'));
    }

 
    public function edit(Demo $demo)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('demo.add',compact('demo'));
    }

    public function update(Request $request, Demo $demo)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        // dd($request->all());exit();
        $request->validate([
            'name'=>'required|string|max:225',
            'age'=>'required|integer',
        ]);

        try {
                $demo->update([
                    'name' => $request->name,
                    'age' => $request->age,
                ]);

                return redirect()->route('demo.index')->with('success', 'Record Successfully Updated!');
            } catch (\Exception $e)
            {
                \Log::error('Demo Update Error: '.$e->getMessage());
                return redirect()->back()->with('error', 'Something went wrong while updating the record!');
            }
    }
    

    public function destroy(Demo $demo)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        try {
            $demo->delete();
            return redirect()->route('demo.index')->with('success', 'Record Successfully Deleted!');
        } catch (\Exception $e) {
            \Log::error('Demo Delete Error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting the record!');
        }
    }
}

