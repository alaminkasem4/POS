<!DOCTYPE html>
<html>
<head>
	<title>Invoice PDF</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td width="25%"><b>Invoice No : #{{$invoice->invoice_no}}</b></td>
							<td width="40%">
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
							<td width="30%"></td>
							<td style="font-size: 20px;"><u><strong> Customer Invoice </strong></u></td>
							<td width="30%"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			@php
     			$payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();
     		@endphp
     		
			</div>		
		</div>
		<div class="row">
			<div class="col-md-12">
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
	          			@endphp
	          			@foreach($invoice['invoice_detial'] as $key => $details)
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
	          				<td class="text-right" colspan="5"><strong>Sub Total</strong></td>
	          				<td  class="text-center"><strong>{{$total_sub}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="5">Discount Amount</td>
	          				<td  class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="5">Paid Amount</td>
	          				<td  class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="5">Deu Amount</td>
	          				<td  class="text-center"><strong>{{$payment->deu_amount}}</strong></td>
	          			</tr>
	          			<tr>
	          				<td class="text-right" colspan="5"><strong>Grand Total</strong></td>
	          				<td  class="text-center"><strong>{{$payment->total_amount}}</strong></td>
	          			</tr>
	          		</tbody>
          		</table>
          		@php
          			$Date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
          		@endphp
          		<i>Printing Time : {{$Date->format('j F y, g:i a')}}</i>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr style="margin-bottom: 0px;">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width: 40%;">
								<p style="text-align: center; margin-left: 20px;">Customer Signature</p>
							</td>
							<td style="width:20%;"></td>
							<td style="width: 40%; text-align: center;">
								<p style="text-align: center; ">Seller Signature</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>