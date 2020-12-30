@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mange Categories</h1>
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
          <h3>Add Category
            <a class="btn btn-success float-right btn-sm" href="{{route('categories.view')}}"><i class="fa fa-list">Categories List</i></a> 
         </h3>
        </div>
        <div class="card-body">
          <form action="{{route('categories.store')}}" method="post" id="From_id" enctype="multipart/form-data">
            @csrf
            <div class="form-row">

            	<div class="form-group col-md-6">
                <label for="name">Name*</label>
                <input type="text" name="name" class="form-control" placeholder="Category Name">
                <font style="color:red;">
                {{($errors->has('name'))?($errors->first('name')):''}}</font>
              </div>

              <div class="form-group col-md-6" style="padding-top: 30px;">
                <input type="submit" value="Submit" class="btn btn-primary">
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
        name:{
          required:true,
        },
        mobile:{
          required:true,
        },
         address:{
          required:true,
        },
      },

      messages:{
        name:{
          required: 'Supplier Name is required!',
        },
        mobile:{
          required: 'Mobile fild is required',
        },
        address:{
          required: 'Address fild is required',
        },
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

