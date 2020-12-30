@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mange Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Add Product
            <a class="btn btn-success float-right btn-sm" href="{{route('products.view')}}"><i class="fa fa-list">Product</i></a> 
         </h3>
        </div>
        <div class="card-body">
          <form action="{{route('products.update',$editData->id)}}" method="post" id="From_id" enctype="multipart/form-data">
            @csrf
            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="supplier_id">Supplier Name *</label>
                <select name="supplier_id" class="form-control select2">
                  @foreach($suppliers as $supplier)
                  <option value="{{$supplier->id}}" {{($editData->supplier_id == $supplier->id)?"selected": ''}}> {{$supplier->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="unit_id">Unit Name *</label>
                <select name="unit_id" class="form-control select2">
                  @foreach($units as $unit)
                  <option value="{{$unit->id}}" {{($editData->unit_id == $unit->id)?"selected": ''}}>{{$unit->name}}</option>
                  @endforeach
                </select>
              </div>   

              <div class="form-group col-md-6">
                <label for="category_id">Category Name *</label>
                <select name="category_id" class="form-control select2">
                  @foreach($categories as $category)
                  <option value="{{$category->id}}" {{($editData->category_id == $category->id)?"selected": ''}}> {{$category->name}}</option>
                  @endforeach
                </select>
              </div>

            	<div class="form-group col-md-6 ">
                <label for="name">Product name *</label>
                <input type="text" name="name" value="{{$editData->name}}" class="form-control form-control-sm">
                <font style="color:red;">
                {{($errors->has('name'))?($errors->first('name')):''}}</font>
              </div>

              <div class="form-group col-md-6">
                <input type="submit" value="Save" class="btn btn-primary ">
              </div>
            </div>
          </form>
        </div>
      </div>
    </section> 
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#From_id').validate({
      rules:{
        supplier_id:{
          required:true,
        },
        unit_id:{
          required:true,
        },
         category_id:{
          required:true,
        },
         name:{
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

