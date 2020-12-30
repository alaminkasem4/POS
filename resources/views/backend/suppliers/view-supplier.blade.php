@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manag Suppliers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Sipplier</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
     
        <div class="card-header">
          <h3>Sippliers View
              <a class="btn btn-success float-right btn-sm" href="{{route('suppliers.add')}}"><i class="fa fa-plus-circle">Add Sipplier</i></a>
          </h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="4%">SL.</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Address</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <div></div>
              @foreach($alldata as $key => $supplier)
              <tr class="{{$supplier->id}}">
                <td>{{$key+1}}</td>
                <td>{{$supplier->name}}</td>
                <td>{{$supplier->mobile}}</td>
                <td>{{$supplier->email}}</td>
                <td>{{$supplier->address}}</td>
                @php
                  $count_supplier = App\Model\Product::where('supplier_id',$supplier->id)->count();
                @endphp
                <td>
                  <a title="edit" class="btn btn-sm btn-primary" href="{{route('suppliers.edit',$supplier->id)}}">
                    <i class="fa fa-edit"></i>
                  </a>
                  @if($count_supplier < 1)
                   <a id="delete" title="delete" class="btn btn-sm btn-danger" href="{{route('suppliers.delete')}}" data-token="{{csrf_token()}}" data-id="{{$supplier->id}}"><i class="fa fa-trash"></i>
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