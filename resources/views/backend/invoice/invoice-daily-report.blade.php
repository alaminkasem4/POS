
@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mange Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Select Criteria</h3>
        </div>
        <form method="get" action="{{route('invoice.daily.report.pdf')}}" target="_blank" id="From_id">
        	<div class="card-body">
	            <div class="form-row">  
	             	<div class="form-group col-md-4">
	                	<label for="start_date">Start Date</label>
	                	<input type="date" name="start_date" id="start_date" class="form-control form-control-sm"  >
	             	 </div>
	               	<div class="form-group col-md-4">
	                	<label for="end_date">End Date</label>
	                	<input type="date" name="end_date" id="end_date" class="form-control form-control-sm"  >
	              	</div>
	              	<div class="form-group form-control-sm col-md-1" style="padding-top: 30px;">
	               		<button type="submit" name="search" class="btn btn-primary btn-sm">Search</button>
	              	</div>
	            </div>
        	</div>
        </form>
      </div>
    </section> 
</div>
<!-- end html -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#From_id').validate({
      rules:{
        start_date:{
          required:true,
        },
        end_date:{
          required:true,
        },
      },

      messages:{
        start_date:{
          required: 'Please Select Start Date',
        },
        end_date:{
          required: 'Please Select End Date',
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
