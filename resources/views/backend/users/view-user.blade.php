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
          <h3>User List
          <a class="btn btn-success float-right btn-sm" href="{{route('users.add')}}"><i class="fa fa-plus-circle">Add user</i></a></h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SL.</th>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($alldata as $key=>$user)
              <tr class="{{$user->id}}">
                <td>{{$key+1}}</td>
                <td>{{$user->usertype}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                  <a title="edit" class="btn btn-sm btn-primary" href="{{route('users.edit',$user->id)}}">
                    <i class="fa fa-edit"></i>
                  </a>
                   <a id="delete" title="delete" class="btn btn-sm btn-danger" href="{{route('users.delete')}}" data-token="{{csrf_token()}}" data-id="{{$user->id}}">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              @endforeach
           </tbody>
          </table>
        </div>
      </div>
    </section> 
</div>

@endsection