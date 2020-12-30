<!DOCTYPE html>
<html>
<head>
	<title>Invoice Daily Report PDF</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td width="15%">@php
          					$Date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
          					@endphp
          					<i><strong>Date :</strong>{{$Date->format('j F y, g:i a')}}</i></td>
							<td width="45%">
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
							<td width="10%"></td>
							<td style="font-size: 20px;"><strong>Date Wise Invoice Report {{date('d-m-y',strtotime($start_date))}} - {{date('d-m-y',strtotime($end_date))}}</strong></td>
							<td width="10%"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table border="1" width="100%">
		            <thead>
		              <tr>
		                <th width="4%">SL.</th>
		                <th>customer Status</th>
		                <th>Invoice No</th>
		                <th>Date</th>
		                <th>Description</th>
		                <th>Total Amount</th>
		              </tr>
		            </thead>
		            <tbody>
	            	@php
	            		$total_sum = 0;
	            	@endphp
		              @foreach($alldata as $key => $invoice)
		              <tr>
		                <td>{{$key+1}}</td>
		                <td>
		                {{$invoice['payment']['customer']['name']}},
		                {{$invoice['payment']['customer']['mobile']}},
		                {{$invoice['payment']['customer']['address']}}
		              </td>
		                <td>#{{$invoice->invoice_no}}</td>
		                <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>  
		                <td>{{$invoice->description}}</td>
		                <td>{{$invoice['payment']['total_amount']}}</td>
		                @php
		                	$total_sum += $invoice['payment']['total_amount'];
		                @endphp
		              </tr>
		              @endforeach
		              <tr>
		              	<td colspan="5" style="text-align: center;"><strong>Grand Total</strong></td>
		              	<td><strong>{{$total_sum}}</strong></td>
		              </tr>
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