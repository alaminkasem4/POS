<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product; 
use App\Model\Supplier; 
use App\Model\Unit;
use App\Model\Category;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customer;
use Auth;
use DB;
use PDF;

class InvoiceController extends Controller
{
     public function view(){
    	$data['alldata'] = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
    	return view('backend.invoice.view-invoice',$data);
    }

    public function add(){
    	$data['categories'] = Category::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
    	if($invoice_data == null){
            $firstReg = '0';
            $data['invoice_no'] = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data+1;
        }
        $data['customers'] = Customer::all();
        $data['date'] = date('Y-m-d');    // current date using
    	return view('backend.invoice.add-invoice',$data);
    }
    
    public function store(Request $request){
       
        if($request->category_id == null){
            return redirect()->back()->with('error','Sorry, You do not Add any Iteam');
        }else{
            if($request->paid_amount > $request->estimated_amount){
                return redirect()->back()->with('error','Sorry! Your Paid Amount Is Very High to Total Price');
            }else{
                $invoice              = new Invoice();
                $invoice->invoice_no  = $request->invoice_no; 
                $invoice->date        = date('Y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status      = '0';
                $invoice->create_by   = Auth::user()->id;
                DB::transaction(function() use($request,$invoice){
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category ; $i++) { 
                            $invoice_detail             = new InvoiceDetail();
                            $invoice_detail->date       = date('Y-m-d',strtotime($request->date));
                            $invoice_detail->invoice_id = $invoice->id;
                            $invoice_detail->category_id= $request->category_id[$i];
                            $invoice_detail->product_id = $request->product_id[$i];
                            $invoice_detail->selling_qty= $request->selling_qty[$i];
                            $invoice_detail->unit_price = $request->unit_price[$i];
                            $invoice_detail->selling_price = $request->selling_price[$i];
                            $invoice_detail->stutas     = '0';
                            $invoice_detail->save();
                        }
                       

                        if($request->customer_id == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile = $request->mobile;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;  // create new customer id
                        }else{
                            $customer_id = $request->customer_id;  // old customer id insert  customer_id
                        }

                        $payment = new Payment();
                        $payment_detail = new PaymentDetail();
                        $payment->invoice_id   = $invoice->id;
                        $payment->customer_id  = $customer_id;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount  = $request->estimated_amount;
                        $payment->paid_status   = $request->paid_status;
                        if($request->paid_status == 'full_paid'){
                            $payment->paid_amount   = $request->estimated_amount;
                            $payment->due_amount    = '0';
                            $payment_detail->current_paid_amount = $request->estimated_amount;
                        }elseif($request->paid_status == 'full_deu'){
                            $payment->paid_amount   = '0';
                            $payment->due_amount    = $request->estimated_amount;
                            $payment_detail->current_paid_amount = '0';
                        }elseif($request->paid_status == 'partical_payment'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_detail->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $payment_detail->invoice_id = $invoice->id;
                        $payment_detail->date = date('Y-m-d',strtotime($request->date));
                        $payment_detail->save();
                    }
                });
            }
        }
        return redirect()->route('invoice.pending.list')->with('success','Invoice Successful');
    }

    public function pendingList(){
        $data['alldata'] = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.invoice.invoice-pending-list',$data);
    }

    public function delete(Request $request){
        $invoice = Invoice::find($request->id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        return redirect()->back()->with('success','Data Delete Successful');
    }

    public function approve($id){
        $invoice = Invoice::with(['invoice_detial'])->find($id);
        return view('backend.invoice.invoice-approved',compact('invoice'));
    }

    public function approveStore(Request $request, $id){
        foreach ($request->selling_qty as $key => $value) {
            $invoice_detials = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_detials->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('error','Sorry You approve Maximum value');
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request,$invoice,$id){
            foreach ($request->selling_qty as $key => $value) {
                $invoice_detials = InvoiceDetail::where('id',$key)->first();
                $invoice_detials->stutas = '1';
                $invoice_detials->save();
                $product = Product::where('id',$invoice_detials->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        return redirect()->route('invoice.pending.list')->with('success','Invoice approval Successfull');
    }

    public function invoice_Print_List(){
        $data['alldata'] = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.pos-invoice-list',$data);
    }

    function invoicePrint($id) {
        $data['invoice'] = Invoice::with(['invoice_detial'])->find($id);
        $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
             
    public function invoiceDailyReport(){
        return view('backend.invoice.invoice-daily-report');
    }

    public function invoiceDailyReportPdf(Request $request){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $data['alldata'] = Invoice::whereBetween('date',[$start_date, $end_date])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.invoice-daily-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    
}
