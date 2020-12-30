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
							<td width="35%"></td>
							<td style="font-size: 20px;"><strong>Stock Report</strong></td>
							<td width="35%"></td>
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
		                <th>SL.</th>
		                <th>Product Name</th>
		                <th>Suppliers</th>
		                <th>Categories</th>
		                <th>In.Qty</th>
		                <th>Out.Qty</th>
		                <th>Stocks</th>
		                <th>Units</th>
		              </tr>
		            </thead>
		            <tbody>
		              
		            @foreach($alldata as $key => $product)
		            @php
		                  $buying_total = App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');

		                  $selling_total = App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('stutas','1')->sum('selling_qty');
	                @endphp
		              <tr>
		                <td>{{$key+1}}</td>
		                <td>{{$product->name}}</td>
		                <td>{{$product['supplier']['name']}}</td>
		                <td>{{$product['category']['name']}}</td>
		                <td>{{$buying_total}}</td>
		                <td>{{$selling_total}}</td>
		                <td>{{$product->quantity}}</td>
		                <td>{{$product['unit']['name']}}</td>
		              </tr>
		              @endforeach
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