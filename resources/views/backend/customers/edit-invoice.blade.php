@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Crdit Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      	<div class="card">
     
	        <div class="card-header">
	          	<h3>Edit Invice
	              	<a class="btn btn-success float-right btn-sm" href="{{route('customers.credit')}}"><i class="fa fa-list"> Credit Customer List</i></a><br>
	              	<strong>Invoice No #{{$payment['invoice']['invoice_no']}}</strong>
	          	</h3>
	        </div>
	        <div class="card-body">
	        	<table width="100%">
	        		<tr>
	        			<td></td>
	        			<td style="font-size: 23px;"><strong><u>Customer Information</u></strong></td>
	        			<td></td>
	        		</tr>
					<tr>
						<td width="35%"><strong>Name : </strong> {{$payment['customer']['name']}}</td>
						<td width="30%"><strong>Mobile : </strong> {{$payment['customer']['mobile']}}</td>
						<td width="35%"><strong>Address : </strong> {{$payment['customer']['address']}}</td>
					</tr>
				</table>
				<form method="post" action="{{route('customers.update.invoice',$payment->invoice_id)}}" id="From_id">
					@csrf
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
		          				<input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
		          				<td  class="text-center"><strong>{{$payment->due_amount}}</strong></td>
		          			</tr>
		          			<tr>
		          				<td class="text-right" colspan="5"><strong>Grand Total</strong></td>
		          				<td  class="text-center"><strong>{{$payment->total_amount}}</strong></td>
		          			</tr>
		          		</tbody>
	          		</table>

          			<div class="row">
	          			<div class="form-group col-md-3">
			                <label style="display: block;">Paid Status</label>
			                <select name="paid_status" id="paid_status" class="paid_status form-control form-control-sm">
			                  <option value="">Select Paid Statusu</option>
			                  <option value="full_paid">Full Paid</option>
			                  <option value="partical_payment">Partical Payment</option>
			                </select>
			                <input type="text" name="paid_amount" id="paid_amount" class="paid_amount form-control form-control-sm" placeholder="Enter Partical payment" style="display: none">
			            </div>
			            <div class="form-group col-md-3">
			                <label for="date">Date</label>
			                <input type="date" name="date" id="date" class="form-control form-control-sm"  min="2019-12-2" max="2060-12-12">
			            </div>
			            <div class="form-group col-md-3" style="padding-top: 30px;">
		                 	<button type="submit" class="btn btn-primary btn-sm">Invoice Update</button>
		                </div>
				    </div>
	          	</form>
	        </div>
     	</div>
    </section> 
</div>

<script type="text/javascript">
  $(document).on('change','#paid_status',function(){
    var paid_status = $(this).val();
    if(paid_status == 'partical_payment'){
      $('#paid_amount').show()
    }else{
      $('#paid_amount').hide();
    }
  });
</script>

<!-- validation -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#From_id').validate({
      rules:{
        paid_status:{
          required:true,
        },
        date:{
          required:true,
        },
      },

      messages:{
      },
      errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });
  });
</script>

@endsection