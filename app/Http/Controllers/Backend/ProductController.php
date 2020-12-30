<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

//        $suppliers = Supplier::all();
        $data['products'] = Product::all();
        $data['users'] = User::all();
        return view('backend.product.index', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        return view('backend.product.add-product', $data);
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
            'supplier_id'=>'required',
            'category_id'=>'required',
            'unit_id'=>'required',
        ]);

        /*$data = new Supplier();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->created_by = auth()->user()->id;
        $data->save();*/

        $request['created_by'] = auth()->user()->id;
        Product::create($request->all());

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
    public function edit($id)
    {
        $data['product'] = Product::findOrFail($id);
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        return view('backend.product.edit-product', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'supplier_id'=>'required',
            'category_id'=>'required',
            'unit_id'=>'required',
        ]);

        $request['updated_by'] = auth()->user()->id;
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Data updated succesfully');

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
        Product::findOrFail($id)->delete();
//        $supplier->delete();
        return redirect()->route('products.index')->with('success', 'Data deleted succesfully');
    }
}
