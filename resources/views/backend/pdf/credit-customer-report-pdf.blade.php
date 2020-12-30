<!DOCTYPE html>
<html>
<head>
	<title>Stocks Report PDF</title>
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
							<td ></td>
							<td style="font-size: 20px; text-align: center;"><strong>Credit Customer Report</strong></td>
							<td ></td>
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
		                <th>Customer Status</th>
		                <th>Invoice No</th>
		                <th>Date</th>
		                <th>Amount</th>
		             </tr>
	            </thead>
	            <tbody>
	              <div></div>
	             	@php
	              		$total_sum = 0;
	             	@endphp
	            @foreach($alldata as $key => $payment)
	            @if($payment->invoice->status=='1')
	             	<tr>
		                <td>{{$key+1}}</td>
		                <td>{{$payment['customer']['name']}}
		                ({{$payment['customer']['mobile']}}-{{$payment['customer']['address']}})</td>
		                <td># {{$payment['invoice']['invoice_no']}}</td>
		                <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
		                <td>{{$payment->due_amount}} .Tk</td>
		            @php
		            	$total_sum += $payment->due_amount;
		            @endphp
	              	</tr>
	            @endif
	            @endforeach
	            	<tr>
	            		<td style="text-align: center" colspan="4"> <strong> Grand Total</strong></td>
	            		<td><strong>{{$total_sum}} .Tk</strong></td>
	            	</tr>
	            </tbody>
          	</table>
			</div>
		</div>
		<br>
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