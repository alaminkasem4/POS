<!DOCTYPE html>
<html>
<head>
	<title>Customer Invoice Details</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td width="28%">@php
          					$Date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
          					@endphp
          					<i><strong>Date :</strong>{{$Date->format('j F y, g:i a')}}</i></td>
							<td width="37%">
								<span style="font-size: 20px; background-color:#0d809300;">Mongola Shopping Mall </span>
								<br> 12/1 Surma,Sylhet
							</td>
							<td width="35%">
								<strong>Call :</strong> +880 01644133400 <br>
								<strong>Email:</strong> alaminkasem4@gmail.com
							</td>
						</tr>
					</tbody>
				</table>
			</div>	
		</div>
		<hr style="margin-bottom: 0px;">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td width="25%"><b>Invoice No : #{{$payment['invoice']['invoice_no']}}</b></td>
							<td style="font-size: 20px; text-align: center;"><strong>Customer Invoice Details</strong></td>
							<td ></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tr>
						<td width="20%"><strong>Customer Info:</strong></td>
						<td width="25%"><strong>Name : </strong> {{$payment['customer']['name']}}</td>
						<td width="25%"><strong>Mobile : </strong> {{$payment['customer']['mobile']}}</td>
						<td width="30%"><strong>Address : </strong> {{$payment['customer']['address']}}</td>
					</tr>
				</table>
				<table border="1" width="100%" style="margin-bottom: 10px;">
		          		<thead>
		          			<tr class="text-center">
		          				<th>SL.</th>
		          				<th>Category</th>
		          				<th>Product Name</th>
		          				<th>Quantiy</th>
		          				<th>Unit Price</th>
		          				<th>Total Price</th>
		          			</tr>
		          		</thead>
		          		<tbody>
		          			@php
		          				$total_sub = '0';
		          				$invoice_detials = App\Model\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
		          			@endphp
		          			@foreach($invoice_detials as $key => $details)
		          			<tr class="text-center">
		          				<input type="hidden" name="category_id[]" value="{{$details->category_id}}">
		          				<input type="hidden" name="product_id[]" value="{{$details->product_id}}">
		          				<input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
			          			<td>{{$key+1}}</td>
			          			<td>{{$details['category']['name']}}</td>
			          			<td>{{$details['product']['name']}}</td>
			          			<td>{{$details->selling_qty}}</td>
			          			<td>{{$details->unit_price}}</td>
			          			<td>{{$details->selling_price}}</td>
		          			</tr>
		          			@php
		          				$total_sub += $details->selling_price;
		          			@endphp
		          			@endforeach
		          			<tr>
		          				<td style="text-align: right;" colspan="5"><strong>Sub Total</strong></td>
		          				<td><strong>{{$total_sub}}</strong></td>
		          			</tr>
		          			<tr>
		          				<td style="text-align: right;" colspan="5">Discount Amount</td>
		          				<td>{{$payment->discount_amount}}</td>
		          			</tr>
		          			<tr>
		          				<td style="text-align: right;" colspan="5">Paid Amount</td>
		          				<td>{{$payment->paid_amount}}</td>
		          			</tr>
		          			<tr>
		          				<td style="text-align: right;" colspan="5">Deu Amount</td>
		          				<td>{{$payment->due_amount}}</td>
		          			</tr>
		          			<tr>
		          				<td style="text-align: right;" colspan="5"><strong>Grand Total</strong></td>
		          				<td><strong>{{$payment->total_amount}}</strong></td>
		          			</tr>
		          			<tr>
		          				<td colspan="6" style="background: #a767e800; text-align: center;"><strong>Paid Summary</strong></td>
		          			</tr>
		          			<tr>
		          				<td colspan="3" style="text-align: center"><strong>Date</strong></td>
		          				<td colspan="3" style="text-align: center"><strong>Paid Amount</strong></td>
		          			</tr>
		          		@php
		          			$payment_detils = App\Model\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
		          		@endphp
		          			
		          			@foreach($payment_detils as $invoice_detail)
		          			<tr>
		          				<td colspan="3" style="text-align: center;">{{date('d-m-Y',strtotime($invoice_detail->date))}}</td>
		          				<td colspan="3" style="text-align: center;">{{$invoice_detail->current_paid_amount}}</td>
		          			</tr>
		          			@endforeach
		          			
		          		</tbody>
	          	</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width: 40%;"></td>
							<td style="width:20%;"></td>
							<td style="width: 40%; text-align: center;">
								<p style="text-align: center; border-bottom: 1px solid #000;">Owner Signature</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>