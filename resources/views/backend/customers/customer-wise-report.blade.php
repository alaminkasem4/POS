@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Customer Wise Credit/Paid</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
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
    				<strong>Customer Credit Wise</strong>
    				<input type="radio" name="customer_wise_report" class="search_value" value="customer_credit_wise">&nbsp;&nbsp;
    				<strong>Customer Credit Paid</strong>
    				<input type="radio" name="customer_wise_report" class="search_value" value="customer_paid_wise">&nbsp;&nbsp;
              <br><br>
    			</div>
    		</div>

    		<div class="show_credit" style="display: none;">
    			<form method="get" action="{{route('customers.credit.wise.pdf')}}" id="customerCredit" target="_blank">
    				<div class="form-row">
    					<div class="col-sm-8">
    						<label>Credit Wise Custoemr</label>
    						<select name="customer_id" class="form-control select2">
    							<option value="">Select Customer</option>
                  @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile}} - {{$customer->address}})</option>
                  @endforeach
    						</select>
    					</div>
    					<div class="col-sm-4"  style="padding-top: 29px; ">
    						<button type="submit" class="btn btn-primary btn-sm">Search</button>
    					</div>
    				</div>
    			</form>
    		</div>

        <div class="show_paid" style="display: none;">
          <form method="get" action="{{route('customers.paid.wise.pdf')}}" id="ProductWise" class="ProductWise" target="_blank">
            <div class="form-row">
              <div class="col-sm-8">
                <label>Paid Wise Custoemr</label>
                <select name="customer_id" class="form-control select2">
                  <option value="">Select Customer</option>
                  @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile}} - {{$customer->address}})</option>
                  @endforeach
                </select>
              </div>

              <div class="col-sm-4"  style="padding-top: 29px; ">
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
    $('#customerCredit').validate({
      ignore:[],
      errorPlacement: function(error, element){
        if(element.attr("name") == "customer_id"){
          error.insertAfter(element.next());}
          else{error.insertAfter(element);}
      },
      errorClass:'text-danger',
      validClass:'text-success',
      rules:{
        customer_id:{
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
        if(element.attr("name") == "customer_id") {error.insertAfter(element.next());}
          else{error.insertAfter(element);}
      },
      errorClass:'text-danger',
      validClass:'text-success',
      rules:{
        customer_id:{
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
		if(search_value == 'customer_credit_wise'){
			$('.show_credit').show();
		}else{
			$('.show_credit').hide();
		}
	});
//product wise
  $(document).on('change','.search_value',function(){
    var search_value = $(this).val();
    if(search_value == 'customer_paid_wise'){
      $('.show_paid').show();
    }else{
      $('.show_paid').hide();
    }
  });
</script>


<!-- using ajax Productshow -->
<!-- <script type="text/javascript">
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
</script> -->

@endsection
