<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product; 
use App\Model\Supplier; 
use App\Model\Unit;
use App\Model\Category;
use Auth;
use PDF;
class StockController extends Controller
{
    public function stockreport(){
    	$data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
    	return view('backend.stocks.stock-report',$data);
    }
    public function stockreportpdf(){
    	$data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
    	$pdf = PDF::loadView('backend.pdf.stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function supplierProudctWise(){
    	$data['suppliers'] = Supplier::all(); 
    	$data['categories'] = Category::all();
    	return view('backend.stocks.supplier-product-wise',$data);
    }

    public function supplierWisePdf(Request $request){
    	$data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
    	$pdf = PDF::loadView('backend.pdf.supplier-wise-stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function ProductWisePdf(Request $request){
    	$data['product'] = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
    	$pdf = PDF::loadView('backend.pdf.product-wise-stock-report-pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
