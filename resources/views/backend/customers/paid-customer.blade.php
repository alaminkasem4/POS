@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Paid Customer</h1>
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
          <h3>Paid Customers List
              <a class="btn btn-success float-right btn-sm" target="_blank" href="{{route('customers.paid.Pdf')}}"><i class="fa fa-download"> Downlod PDF</i></a>
          </h3>
        </div>
        <div class="card-body">
          	<table id="example1" class="table table-bordered table-striped">
	            <thead>
		            <tr>
		                <th width="4%">SL.</th>
		                <th>Customer Status</th>
		                <th>Invoice No</th>
		                <th>Date</th>
		                <th>Amount</th>
		                <th width="10%">Action</th>
		             </tr>
	            </thead>
	            <tbody>
	              <div></div>
                @php
                    $total_sum = 0;
                @endphp
	            @foreach($alldata as $key => $payment)
	             	<tr>
		                <td>{{$key+1}}</td>
		                <td>{{$payment['customer']['name']}}
		                ({{$payment['customer']['mobile']}}-{{$payment['customer']['address']}})</td>
		                <td># {{$payment['invoice']['invoice_no']}}</td>
		                <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
		                <td>{{$payment->paid_amount}} .Tk</td>
		                <td>
		                   <a title="details" class="btn btn-sm btn-success" target="_blank" href="{{route('customers.datails.invoice.pdf',$payment->invoice_id)}}"><i class="fa fa-eye"></i>
		                  </a>
		                </td>
                @php
                  $total_sum += $payment->paid_amount;
                @endphp
	              	</tr>
	            @endforeach
	           </tbody>
                  <tr>
                    <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
                    <td colspan="2"><strong>{{$total_sum}}.Tk</strong></td>
                  </tr>
          </table>
        </div>
      </div>
    </section> 
</div>





@endsection