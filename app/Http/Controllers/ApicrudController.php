<?php

namespace App\Http\Controllers;
use App\Models\Apicrud;
use Illuminate\Http\Request;

class ApicrudController extends Controller
{
 
    public function index()
    {
        $Cruds=Apicrud::latest()->paginate(5);
        return view('api_crud.index',compact('Cruds'));
    }

   
    public function create()
    {
        return view('api_crud.add');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:225',
            'email'=>'required',
        ]);

        $data =[
            'name'=>$request->name,
            'email'=>$request->email
        ];
         Apicrud::Create($data);
        return redirect()->route('api_crud.index')->with('success','Record is succesfully Inserted!');
    }

  
    public function show(string $id)
    {
        
        
    }

    
    public function edit($id)
    {
        $crud=Apicrud::findorfail($id);
        return view('api_crud.add',compact('crud'));
        
    }

  public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:225',
            'email' => 'required|email|unique:apicruds,email,' . $id,
        ]);

        $crud = Apicrud::findOrFail($id);

        $crud->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('api_crud.index')
            ->with('success','Record successfully updated!');
    }


 
  public function destroy($id)
    {
        $crud = Apicrud::findOrFail($id);
        $crud->delete();

        return redirect()->route('api_crud.index')
            ->with('success','Record deleted successfully!');
    }

}
