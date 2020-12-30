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
          <h3>Edit User
            <a class="btn btn-success float-right btn-sm" href="{{route('users.view')}}"><i class="fa fa-list">User List </i></a> 
         </h3>
        </div>
        <div class="card-body">
        	<form action="{{route('users.update',$editdata->id)}}" method="post" id="From_id">
        		@csrf
        		<div class="form-row">
        			<div class="form-group col-md-4">
        				<label for="usertype">User Role</label>
        				<select name="usertype" id="usertype" class="form-control">
                  <option value="">Select Role</option>
                  <option value="Admin" {{($editdata->usertype=="Admin")?"selected":""}}>Admin</option>
                  <option value="Moderator"{{($editdata->usertype=="Moderator")?"selected":""}}>Moderator</option>
                </select> 
                <font style="color:red;">
                {{($errors->has('usertype'))?($errors->first('usertype')):''}}</font>
        			</div>
        			<div class="form-group col-md-4">
        				<label for="name">Name</label>
        				<input type="text" name="name" value="{{$editdata->name}}" class="form-control">
        				<font style="color:red;">{{($errors->has('name'))?($errors->first('name')):''}}</font>
        			</div>
        			<div class="form-group col-md-4">
        				<label for="email">Email</label>
        				<input type="email" name="email" value="{{$editdata->email}}" class="form-control">
        				<font style="color:red;">{{($errors->has('email'))?($errors->first('email')):''}}</font>
        			</div>
        		
        			<div class="form-group col-md-4">
        				<input type="submit" value="Update" class="btn btn-primary">
        			</div>
        		</div>
        	</form>
        </div>
      </div>
    </section> 
</div>


@endsection

