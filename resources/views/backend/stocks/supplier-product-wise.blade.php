@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manag Supplier/Product wise Stocks</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Stock</li>
            </ols>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">s
    <div class="card">
     
        <div class="card-header">
          <h3>Select Criteria</h3>
        </div>
    	<div class="card-body">
    		<div class="row">
    			<div class="col-sm-12  text-center">
    				<strong>Supplier Wise Report</strong>
    				<input type="radio" name="supplier_product_wise" class="search_value" value="supplier_wise">&nbsp;&nbsp;
    				<strong>Product Wise Report</strong>
    				<input type="radio" name="supplier_product_wise" class="search_value" value="product_wise">&nbsp;&nbsp;
              <br><br>
    			</div>
    		</div>

    		<div class="show_supplier" style="display: none;">
    			<form method="get" action="{{route('stocks.report.supplier.wise.pdf')}}" id="supplierWise" target="_blank">
    				<div class="form-row">
    					<div class="col-sm-8">
    						<label>Supplier Name</label>
    						<select name="supplier_id" class="form-control select2">
    							<option value="">Select Suppliers</option>
    							@foreach($suppliers as $supplier)
    							<option value="{{$supplier->id}}">{{$supplier->name}}</option>
    							@endforeach
    						</select>
    					</div>
    					<div class="col-sm-4"  style="padding-top: 29px; ">
    						<button type="submit" class="btn btn-primary btn-sm">Search</button>
    					</div>
    				</div>
    			</form>
    		</div>

        <div class="show_product_wise" style="display: none;">
          <form method="get" action="{{route('stocks.report.product.wise.pdf')}}" id="ProductWise" class="ProductWise" target="_blank">
            <div class="form-row">

              <div class="col-md-4">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control select2">
                  <option value="">Select Category</option>
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label for="product_id">Product Name</label>
                <select name="product_id" id="product_id" class="form-control select2">
                  <option value="">Select Product</option>
                </select>
              </div>

              <div class="col-sm-2"  style="padding-top: 29px; ">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
              </div>
            </div>
          </form>
        </div>

    	</div>
    </div>
    </section> 
</div>



<!-- validation supplier wise-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#supplierWise').validate({
      ignore:[],
      errorPlacement: function(error, element){
        if(element.attr("name") == "supplier_id"){
          error.insertAfter(element.next());}
          else{error.insertAfter(element);}
      },
      errorClass:'text-danger',
      validClass:'text-success',
      rules:{
        supplier_id:{
          required:true,
        },
      },

      messages:{
      },
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#ProductWise").validate({
      ignore:[],
      errorPlacement: function(error, element){
        if(element.attr("name") == "category_id") {error.insertAfter(element.next());}
        else if(element.attr("name") == "product_id") {error.insertAfter(element.next());}
          else{error.insertAfter(element);}
      },
      errorClass:'text-danger',
      validClass:'text-success',
      rules:{
        category_id:{
          required:true,
        },
        product_id:{
          required:true,
        },
      },

      messages:{
      },
    });
  });
</script>


<!-- radio button show hide -->
<script type="text/javascript">
  // supplier wise
	$(document).on('change','.search_value',function(){
		var search_value = $(this).val();
		if(search_value == 'supplier_wise'){
			$('.show_supplier').show();
		}else{
			$('.show_supplier').hide();
		}
	});
//product wise
  $(document).on('change','.search_value',function(){
    var search_value = $(this).val();
    if(search_value == 'product_wise'){
      $('.show_product_wise').show();
    }else{
      $('.show_product_wise').hide();
    }
  });
</script>



<!-- using ajax Productshow -->
<script type="text/javascript">
  $(function(){
    $(document).on('change', '#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url:"{{route('get_product')}}",
        type:"GET",
        data:{category_id:category_id}, //first category id using controller and 2nd category_id using to variavle/var
        success:function(data){
          var html = '<option value="">Select Product</option>';
          $.each(data,function(key,v){
            html += '<option value="'+v.id+'">'+v.name+'</option>';
          });
          $('#product_id').html(html); // showing foreach this id
        }
      });
    });
  });
</script>
@endsection
