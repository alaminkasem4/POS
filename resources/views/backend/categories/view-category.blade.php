@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manag Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
     
        <div class="card-header">
          <h3>Categories View
              <a class="btn btn-success float-right btn-sm" href="{{route('categories.add')}}"><i class="fa fa-plus-circle">Add Category</i></a>
          </h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="4%">SL.</th>
                <th>Name</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <div></div>
              @foreach($alldata as $key => $category)
              <tr class="{{$category->id}}">
                <td>{{$key+1}}</td>
                <td>{{$category->name}}</td>
                @php
                  $count_category = App\Model\Product::where('category_id',$category->id)->count();
                @endphp
                <td>
                  <a title="edit" class="btn btn-sm btn-primary" href="{{route('categories.edit',$category->id)}}">
                    <i class="fa fa-edit"></i>
                  </a>
                  @if($count_category < 1)
                   <a id="delete" title="delete" class="btn btn-sm btn-danger" href="{{route('categories.delete')}}" data-token="{{csrf_token()}}" data-id="{{$category->id}}"><i class="fa fa-trash"></i>
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