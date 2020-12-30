@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Manage</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Add New User
          <a class="btn btn-success float-right btn-sm" href="{{route('users.view')}}"><i class="fa fa-list">User List</i></a></h3>
        </div>
        <div class="card-body">
        	<form action="{{route('users.store')}}" method="post" id="From_id">
        		@csrf
        		<div class="form-row">
        			<div class="form-group col-md-4">
        				<label for="usertype">User Role</label>
        				<select name="usertype" id="usertype" class="form-control">
        					<option value="">Select Role</option>
        					<option value="Admin">Admin</option>
        					<option value="Moderator">Moderator</option>
        				</select>	
                <font style="color:red;">
                {{($errors->has('usertype'))?($errors->first('usertype')):''}}</font>
        			</div>
        			<div class="form-group col-md-4">
        				<label for="name">Name</label>
        				<input type="text" name="name"  class="form-control">
        				<font style="color:red;">{{($errors->has('name'))?($errors->first('name')):''}}</font>
        			</div>
        			<div class="form-group col-md-4">
        				<label for="email">Email</label>
        				<input type="email" name="email" class="form-control">
        				<font style="color:red;">{{($errors->has('email'))?($errors->first('email')):''}}</font>
        			</div>
        			<div class="form-group col-md-4">
        				<label for="new_password">New Password</label>
        				<input type="password" name="new_password" id="new_password" class="form-control">
                <font style="color:red;">
                {{($errors->has('new_password'))?($errors->first('new_password')):''}}</font>
        			</div>
        			<div class="form-group col-md-4">
        				<label for="confrim_password">Confirm Password</label>
        				<input type="password" name="confrim_password" id="confrim_password" class="form-control">
                <font style="color:red;">
               
        			</div>
        			<div class="form-group col-md-4" style="padding-top:30px;">
        				<input type="submit" value="submit" class="btn btn-primary">
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
        usertype:{
          required:true,
        },
        name:{
          required:true,
        },
         email:{
          required:true,
          email:true,
        },
        new_password:{
          required:true,
          minlength:8,
        },
        confrim_password:{
          required:true,
          equalTo: '#new_password'
        }
      },

      messages:{
        usertype:{
          required: 'Selcet User Rule',
        },
        name:{
          required: 'Please Enter Your Name',
        },
        email:{
          required: 'Please Enter Your Email',
          email: 'Please Enter <em> valid</em> Email',
        },
        new_password:{
          required: 'Please Enter New Password',
          minlength: 'Password Minimum 8 Number Or Char',
        },
        confrim_password:{
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

