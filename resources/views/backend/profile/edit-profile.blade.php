@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Edit Profile
            <a class="btn btn-success float-right btn-sm" href="{{route('profile.view')}}"><i class="fa fa-arrow-left">Go Back</i></a> 
         </h3>
        </div>
        <div class="card-body">
        	<form action="{{route('profile.update')}}" method="post" id="From_id" enctype="multipart/form-data">
        		@csrf
        		<div class="form-row">

        			<div class="form-group col-md-4">
        				<label for="name">Name</label>
        				<input type="text" name="name" value="{{$edit->name}}" class="form-control">
        				<font style="color:red;">{{($errors->has('name'))?($errors->first('name')):''}}</font>
        			</div>

        			<div class="form-group col-md-4">
        				<label for="email">Email</label>
        				<input type="email" name="email" value="{{$edit->email}}" class="form-control">
        				<font style="color:red;">{{($errors->has('email'))?($errors->first('email')):''}}</font>
        			</div>

        		  <div class="form-group col-md-4">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" value="{{$edit->mobile}}" class="form-control">
                <font style="color:red;">{{($errors->has('mobile'))?($errors->first('mobile')):''}}</font>
              </div>
              
        			<div class="form-group col-md-4">
        				<label for="gender">Gender</label>
        				<select name="gender" id="gender" class="form-control">
        					<option value="">Select Gende</option>
        					<option value="Male" {{($edit->gender=="Male")?"selected":""}}>Male</option>
                  <option value="Female"{{($edit->gender=="Female")?"selected":""}}>Female</option>
        				</select>	
                <font style="color:red;">
                {{($errors->has('gender'))?($errors->first('gender')):''}}</font>
        			</div>

              <div class="form-group col-md-4">
                <label for="mobile">Address</label>
                <input type="text" name="address" value="{{$edit->address}}" class="form-control">
                <font style="color:red;">{{($errors->has('address'))?($errors->first('address')):''}}</font>
              </div>

              <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image">
              </div>
              <div class="form-group col-md-2">
                <img id="showImage" src="{{(!empty($edit->image))?url(('upload/user_img/').$edit->image):url('upload/no.jpg')}}" style="width: 150px; height: 160px;border: 1px solid #000;">
              </div>

        			<div class="form-group col-md-6" style="padding-top: 50px;">
        				<input type="submit" value="Update" class="btn btn-primary">
        			</div>
        		</div>
        	</form>
        </div>
      </div>
    </section> 
</div>




@endsection

