@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content --> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manag Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
    <div class="card">
     
	    <div class="card-header">
	      <h3> <strong>Invoice No:</strong> #{{$invoice->invoice_no}} ({{date('d-m-y',strtotime($invoice->date))}})
	          <a class="btn btn-success float-right btn-sm" href="{{route('invoice.pending.list')}}"><i class="fa fa-list"> Panding Invoice List</i></a>
	      </h3>
	    </div>
     	<div class="card-body">
     		@php
     			$payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();
     		@endphp
         	<table width="100%">
	            <tbody>
	            	<tr>
	            		<td width="15%"><strong>Customer Info</strong></td>
	            		<td width="25%"><strong>Name : </strong> {{$payment['customer']['name']}}</td>
	            		<td width="35%"><strong>Mobile/Email : </strong>{{$payment['customer']['mobile']}}
	            		({{$payment['customer']['email']}})</td>
	            		<td width="25%"><strong>Address : </strong>{{$payment['customer']['address']}}</td>
	            	</tr>
	            	<tr>
	            		<td width="15%"></td>
	            		<td width="85%" colspan="3"><p></p><strong>Description : </strong>{{$invoice->description}}</p></td>
	            	</tr>
	          	</tbody>
          	</table>
          	<form method="post" action="{{route('invoice.approval.store',$invoice->id)}}">
          	@csrf
          		<table border="1" width="100%" style="margin-bottom: 10px;">
	          		<thead>
	          			<tr class="text-center">
	          				<th>SL.</th>
	          				<th>Category</th>
	          				<th>Product Name</th>
	          				<th style="background: #ddd; padding: 1px;">Current Stock</th>
	          				<th>Quantiy</th>
	          				<th>Unit Price</th>
	          				<th>Total Price</th>
	          			</tr>
	          		</thead>
	          		<tbody>
	          			@php
	          				$total_sub = '0';
	          			@endphp
	          			@foreach($invoice['invoice_detial'] as $key => $details)
	          			<tr class="text-center">
	          				<input type="hidden" name="category_id[]" value="{{$details->category_id}}">
	          				<input type="hidden" name="product_id[]" value="{{$details->product_id}}">
	          				<input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
		          			<td>{{$key+1}}</td>
		          			<td>{{$details['category']['name']}}</td>
		          			<td>{{$details['product']['name']}}</td>
		          			<td style="background: #ddd; padding: 1px;">{{$details['product']['quantity']}}</td>
		          			<td>{{$details->selling_qty}}</td>
		          			<td>{{$details->unit_price}}</td>
		          			<td>{{$details->selling_price}}</td>
	          			</tr>
	          			@php
	          				$total_sub += $details->selling_price;
	          			@endphp
	          			@endforeach
	          			<tr>
	          				<td class="text-right" colspan="6"><strong>Sub Total</strong></td>
	          				<td  class="text-center"><strong>{{$total_sub}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="6">Discount Amount</td>
	          				<td  class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="6">Paid Amount</td>
	          				<td  class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="6">Deu Amount</td>
	          				<td  class="text-center"><strong>{{$payment->due_amount}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="6"><strong>Grand Total</strong></td>
	          				<td  class="text-center"><strong>{{$payment->total_amount}}</strong></td>
	          			</tr>
	          		</tbody>
          		</table>
          		<button type="submit" class="btn btn-success">Invoice Approval</button>
          	</form>
        </div>
    </div>
    </section> 
</div>


@endsection
