@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manag Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
    <div class="card">
     
        <div class="card-header">
          <h3>Product View
              <a class="btn btn-success float-right btn-sm" href="{{route('products.add')}}"><i class="fa fa-plus-circle">Add Product</i></a>
          </h3>
        </div>
     <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="4%">SL.</th>
                <th>Name</th>
                <th>Unit Name</th>
                <th>Category Name</th>
                <th>Supplier Name</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <div></div>
              @foreach($alldata as $key => $product)
              <tr class="{{$product->id}}">
                <td>{{$key+1}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product['unit']['name']}}</td>  
                <td>{{$product['category']['name']}}</td>
                <td>{{$product['supplier']['name']}}</td>
                @php
                  $count_product = App\Model\Purchase::where('product_id',$product->id)->count();
                @endphp
                <td>
                  <a title="edit" class="btn btn-sm btn-primary" href="{{route('products.edit',$product->id)}}">
                    <i class="fa fa-edit"></i>
                  </a>
                  @if($count_product < 1)
                   <a id="delete" title="delete" class="btn btn-sm btn-danger"  href="{{route('products.delete')}}" data-token="{{csrf_token()}}" data-id="{{$product->id}}"><i class="fa fa-trash"></i>
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
