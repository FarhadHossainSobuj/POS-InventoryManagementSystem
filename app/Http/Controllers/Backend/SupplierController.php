<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $suppliers = Supplier::all();
        $data['suppliers'] = Supplier::all();
        $data['users'] = User::all();
        return view('backend.suppliers.index', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.suppliers.add-supplier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        /*$data = new Supplier();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->created_by = auth()->user()->id;
        $data->save();*/

        $request['created_by'] = auth()->user()->id;
        Supplier::create($request->all());

        return redirect()->back()->with('success', 'Success! Data successfully inserted!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
//        $supplier = Supplier::findOrFail($id);
        return view('backend.suppliers.edit-supplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $request['updated_by'] = auth()->user()->id;
        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Data updated succesfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('ok');
    }

    public function delete($id)
    {
        Supplier::findOrFail($id)->delete();
//        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Data deleted succesfully');
    }
}
