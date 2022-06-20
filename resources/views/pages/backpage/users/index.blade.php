
@extends('layouts/backpage/base')
@section('title', 'Users Management')
@section('content') 
<div class="page-body">
	<div class="container-fluid">
	    <div class="page-title">
		    <div class="row">
                <div class="col-lg-6">
                    <a class="btn btn-success btn-sm" href="{{ route('users.create') }}"> Create New User</a>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url ('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#"><i data-feather="users"></i></a></li>
                        <li class="breadcrumb-item active">Users Management</li>
                    </ol>
                </div>
	        </div>
	    </div>
    </div>
    
    <div class="container-fluid">
        @if ($message = Session::get('success'))
          <div class="alert alert-success dark alert-dismissible fade show" role="alert" id="success-alert">
            <p> <i data-feather="thumbs-up"></i> {{ $message }}</p>
          </div>
        @endif
        <div class="row starter-main">
            <div class="col-xl-9 xl-100 box-col-12">
                <div class="row">
                  <div class="col-xl-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="best-seller-table responsive-tbl">
                          <div class="item">
                            <div class="table-responsive product-list">
                              <table class="table table-bordernone">
                                <thead>
                                  <tr>
                                    <th class="f-22">Users</th>
                                    <th>Email</th>
                                    <th class="text-center">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                @if($user->image)
                                                <img id="preview" class="img-40 m-r-15 rounded-circle align-top" src="{{ ('/img/user/'.$user->image) }}" alt="{{ $user->name }}">
                                                @else
                                                <img id="preview" src="https://via.placeholder.com/150" class="img-40 m-r-15 rounded-circle align-top hidden">
                                                @endif
                                                <div class="status-circle bg-primary"></div>
                                                <div class="d-inline-block"><span>{{ $user->name }}</span>
                                                <p class="font-roboto">
                                                  @if (!empty($user->getRoleNames()))
                                                      @foreach ($user->getRoleNames() as $v) 
                                                          {{ $v }}
                                                      @endforeach
                                                  @endif
                                                </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-pill" role="group" >
                                              <a class="btn btn-warning btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                              {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                              {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {!! $data->render() !!}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
      $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
      });
});
</script>

@endsection