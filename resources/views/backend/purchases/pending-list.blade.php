@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manag Purchases</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Pending List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
    <div class="card">
     
        <div class="card-header">
          <h3>Purchases Pendign List
              <a class="btn btn-success float-right btn-sm" href="{{route('purchases.view')}}"><i class="fa fa-plus-circle">Approval List</i></a>
          </h3>
        </div>
     <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                <th width="4%">SL.</th>
                <th>Purchase No</th>
                <th>Date</th>
                <th>Supplier</th>
                <th>Category</th>
                <th>Product</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Buying Price</th>
                <th>Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <div></div>
              @foreach($alldata as $key => $purchase)
              <tr class="{{$purchase->id}}">
                <td>{{$key+1}}</td>
                <td>{{$purchase->purchase_no}}</td>
                <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                <td>{{$purchase['supplier']['name']}}</td>  
                <td>{{$purchase['category']['name']}}</td>
                <td>{{$purchase['product']['name']}}</td>
                <td>{{$purchase->description}}</td>  
                <td>
                  {{$purchase->buying_qty}}
                  {{$purchase['product']['unit']['name']}}
                </td>
                <td>{{$purchase->unit_qty}}</td>  
                <td>{{$purchase->buyingt_price}}</td>  
                <td>
                  @if($purchase->status  == '0')
                    <span style="background: #FC4236; padding: 5px;">Pending</span>
                    @elseif($purchase->status == '1')
                    <span style="background: #5EAB00; padding: 5px;">Approved</span>
                    @endif
                </td>
                <td>
                  @if($purchase->status == '0')
                   <a id="approvedBtn" title="approved" class="btn btn-sm btn-success approvedBtn" href="{{route('purchases.approved')}}" data-token="{{csrf_token()}}" data-id="{{$purchase->id}}"><i class="fa fa-check-circle"></i>
                  </a>
                  @endif
                </td>
              </tr>
              @endforeach
           </tbody>
          </table>
        </div>
      </div>
    </section> 
</div>


@endsection
