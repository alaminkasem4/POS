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
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-4 offset-md-4">
     <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="{{(!empty($data->image))?url(('upload/user_img/').$data->image):url('upload/no.jpg')}}"
                 alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{$data->name}}</h3>

          <p class="text-muted text-center">{{$data->usertype}}</p>

            <table width="100%" class="table table-bordered">
              <tr>
                <td>Mobile</td>
                <td>{{$data->mobile}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{$data->email}}</td>
              </tr>
              <tr>
                <td>Gender</td>
                <td>{{$data->gender}}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td>{{$data->address}}</td>
              </tr>
            </table>

          <a href="{{route('profile.edit')}}" class="btn btn-primary btn-block"><b>Edit</b></a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section> 
</div>

@endsection