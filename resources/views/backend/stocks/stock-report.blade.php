@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manag Stocks</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Stock</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
    <div class="card">
     
        <div class="card-header">
          <h3>Stock List
              <a class="btn btn-primary float-right btn-sm" target="_blank" href="{{route('stocks.report.pdf')}}"><i class="fa fa-print"> Stock pdf</i></a>
          </h3>
        </div>
    	<div class="card-body">
         	<table id="example1" class="table table-bordered table-striped">
	            <thead>
	              <tr>
	                <th width="4%">SL.</th>
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
    </section> 
</div>


@endsection
