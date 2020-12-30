<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $data['purchases'] = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        $data['users'] = User::all();
        return view('backend.purchase.index', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['suppliers'] = Supplier::all();
        /*$data['units'] = Unit::all();
        $data['products'] = Product::all();
        $data['categories'] = Category::all();*/
        return view('backend.purchase.add-purchase', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->category_id == null){
            return redirect()->back()->with('error', 'Sorry! You do not select any item');
        }
        else {
            $count_category = count($request->category_id);
            for($i = 0; $i < $count_category; $i++){
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = auth()->user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }
        return redirect()->route('purchases.index')->with('success', 'Data saved successfully');

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
        $data['purchase'] = Purchase::findOrFail($id);
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        return view('backend.purchase.edit-purchase', $data);

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
        $product = Purchase::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'supplier_id'=>'required',
            'category_id'=>'required',
            'unit_id'=>'required',
        ]);

        $request['updated_by'] = auth()->user()->id;
        $product->update($request->all());

        return redirect()->route('purchases.index')->with('success', 'Data updated succesfully');

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
        Purchase::findOrFail($id)->delete();
//        $supplier->delete();
        return redirect()->route('purchases.index')->with('success', 'Data deleted succesfully');
    }

    public function pendingList(){
        $data['purchases'] = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        $data['users'] = User::all();
        return view('backend.purchase.view-pending-list', $data );
    }
    public function approve($id){
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            $purchase->status = 1;
            $purchase->update();
            /*DB::table('purchases')
                ->where('id', $id)
                ->update(['status'=>1]);*/
        }
        return redirect()->route('purchases.pending.list')->with('success', 'Data saved successfully');
    }
}
