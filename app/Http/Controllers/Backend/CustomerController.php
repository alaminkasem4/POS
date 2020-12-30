<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Model\Customer; 
use App\Model\Payment; 
use App\Model\PaymentDetail;
use App\Model\Invoice;
use Auth;
use PDF;

class CustomerController extends Controller
{
    public function view(){
    	$data['alldata'] = Customer::all();
    	return view('backend.customers.view-customer',$data);
    }

    public function add(){
    	return view('backend.customers.add-customer');
    }
    
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
            'mobile'   =>'required|unique:customers|max:11|min:11',
            'address'   =>'required',
        ]);

        $data = new Customer();
        $data->create_by  = Auth::user()->id;
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
    	return redirect()->route('customers.view')->with('success',' Data Inserted Successful');
    }

    public function edit($id){
    	$editData = Customer::find($id);
    	return view('backend.customers.edit-customer',compact('editData'));
    }

    public function update(CustomerRequest $request,$id){

        $data = Customer::find($id);
        $data->update_by  = Auth::user()->id;
        $data->name       = $request->name;
        $data->mobile     = $request->mobile;
        $data->email 	  = $request->email;
        $data->address 	  = $request->address;
        $data->save();

        return redirect()->route('suppliers.view')->with('success','Data Update Successful');
    }

    public function delete(Request $request){
    	$delete_data = Customer::find($request->id);
        $delete_data->delete();
    	return redirect()->back()->with('success','Data Delete Successful');
    }

    public function creditCustomer(){
        $data['alldata'] = Payment::whereIn('paid_status',['full_deu','partical_payment'])->get();
        return view('backend.customers.credit-customer',$data);
    }
    public function creditCustomerPdf(Request $request){
        $data['alldata'] =  Payment::whereIn('paid_status',['full_deu','partical_payment'])->get();
        $pdf = PDF::loadView('backend.pdf.credit-customer-report-pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function editInvoice($invoice_id){
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.customers.edit-invoice',$data);
    }
    public function updateInvoice(Request $request,$invoice_id){
        if($request->new_paid_amount < $request->paid_amount){
            return redirect()->back()->with('error','Sorry! You Have Paid Maximum Value');
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_detail = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_detail->current_paid_amount =  $request->new_paid_amount;
            }else if($request->paid_status = 'partical_payment'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount'] - $request->paid_amount;
                $payment_detail->current_paid_amount = $request->paid_amount; 
            }
            $payment->save();
            $payment_detail->invoice_id = $invoice_id;
            $payment_detail->date = date('Y-m-d',strtotime($request->date));
            $payment_detail->updated_by = Auth::user()->id;
            $payment_detail->save();
        }
        return redirect()->route('customers.credit')->with('success','Invoice successfuly Update');
    }

    public function invoiceDetailPdf($invoice_id){
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $pdf = PDF::loadView('backend.pdf.invoice-details-pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function PaidCustomer(){
        $data['alldata'] = Payment::where('paid_status','!=','full_deu')->get();
        return view('backend.customers.paid-customer',$data);
    }
    public function PaidCustomerPdf(){
        $data['alldata'] = Payment::where('paid_status','!=','full_deu')->get();
        $pdf = PDF::loadView('backend.pdf.paid-customer-report-pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function CustomerWiserReport(){
        $data['customers'] = Customer::all();
        return view('backend.customers.customer-wise-report',$data);
    }
    public function CustomerCreditWiserPdf(Request $request){
         $data['alldata'] =  Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_deu','partical_payment'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-wise-credit-pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function CustomerPaidWiserPdf(Request $request){
        $data['alldata'] = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_deu')->get();
        $pdf = PDF::loadView('backend.pdf.customer-paid-wise-pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
