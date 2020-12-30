@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Change Password</h3>
        </div>
        <div class="card-body">
        	<form action="{{route('profile.password_update')}}" method="post" id="From_id">
        		@csrf
        		<div class="form-row">
        			<div class="form-group col-md-4">
        				<label for="current_password">Current Password</label>
        				<input type="password" name="current_password" id="current_password" class="form-control">
        			</div>	
        			<div class="form-group col-md-4">
        				<label for="new_password">New Password</label>
        				<input type="password" name="new_password" id="new_password" class="form-control">
        			</div>
        			<div class="form-group col-md-4">
        				<label for="confirm_new_password">Confirm New Password</label>
        				<input type="password" name="confirm_new_password" id="confirm_new_password"  class="form-control">
        			</div>

        			<div class="form-group col-md-4">
        				<input type="submit" value="Save" class="btn btn-primary">
        			</div>
        		</div>
        	</form>

        </div>
      </div>
    </section> 
</div>

<!-- validation -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#From_id').validate({
			rules:{
				current_password:{
					required:true,
				},
				new_password:{
					required:true,
					minlength:8,
				},
				confirm_new_password:{
					required:true,
					equalTo: '#new_password'
				}
			},

			messages:{
				current_password:{
					required: 'Please Enter Current Password',
				},
				new_password:{
					required: 'Please Enter New Password',
					minlength: 'Password Minimum 8 Number Or Char',
				},
				confirm_new_password:{
					required: 'Confirm New Password',
					minlength:'Password Minimum 8 Number Or Char',
				}
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

