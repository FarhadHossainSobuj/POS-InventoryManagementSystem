<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class StockController extends Controller
{
    public function stockReport()
    {
//        $suppliers = Supplier::all();
        $data['products'] = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('backend.stock.stock-report', $data );
    }
    public function supplierProductWise()
    {
//        $suppliers = Supplier::all();
        $data['products'] = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('backend.stock.supplier-product-wise-report', $data );
    }
    public function stockReportPdf()
    {
        $data['products'] = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        //        $suppliers = Supplier::all();
        $pdf = PDF::loadView('backend.pdf.stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
