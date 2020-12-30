<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product; 
use App\Model\Supplier; 
use App\Model\Unit;
use App\Model\Category;
use App\Model\Purchase;
use Auth;
use DB;
use PDF;

class PurchaseController extends Controller
{
     public function view(){
    	$data['alldata'] = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get(); // sort by desc (last date first show)
    	return view('backend.purchases.view-purchase',$data);
    }

    public function add(){
    	$data['suppliers'] 	= Supplier::all();
    	$data['units'] 		= Unit::all();
    	$data['categories'] = Category::all();
    	$data['purchase']	= Purchase::all();
        // $data['date'] = date('Y-m-d');
    	return view('backend.purchases.add-purchase',$data);
    }
    
    public function store(Request $request){
        if($request->category_id == null){
            return redirect()->back()->with('error','Sorry, You do not select any item');
        }else{
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) { 
                $purchase = new Purchase();
                $purchase->date         = date('Y-m-d',strtotime($request->date[$i]));
                $purchase->purchase_no  = $request->purchase_no[$i];
                $purchase->supplier_id  = $request->supplier_id[$i];
                $purchase->category_id  = $request->category_id[$i];
                $purchase->product_id   = $request->product_id[$i];
                $purchase->buying_qty   = $request->buying_qty[$i];
                $purchase->unit_qty   = $request->unit_price[$i];
                $purchase->buyingt_price = $request->buying_price[$i];
                $purchase->description  = $request->description[$i];
                $purchase->create_by    = Auth::user()->id;
                $purchase->status      = '0';
                $purchase->save();
            }
        }
        return redirect()->route('purchases.pending.list')->with('success','Data save Successfyll');

    }

    // public function delete($id){
    // 	$delete_data = Purchase::find($id);
    //     $delete_data->delete();
    // 	return redirect()->back()->with('success','Data Delete Successful');
    // }

    public function pendingList(){
        $data['alldata'] = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get(); // sort by desc (last date first show)
        return view('backend.purchases.pending-list',$data);
    }

    public function approve(Request $request){
        $purchase = Purchase::find($request->id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')
                    ->where('id',$request->id)
                    ->update(['status'=> 1]);
        }
        return redirect()->back()->with('success','Data Approved Successful');
    }

    public function purchaseReport(){
        return  view('backend.purchases.date-wise-purchase-report');
    }

    public function purchaseReportPdf(Request $request){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $data['alldata'] = Purchase::whereBetween('date',[$start_date, $end_date])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.purchase-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
