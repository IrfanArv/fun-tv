
@extends('layouts/backpage/base')
@section('title', 'Roles')
@section('content') 
<div class="page-body">
	<div class="container-fluid">
	    <div class="page-title">
		    <div class="row">
                <div class="col-lg-6">
                  @can('role-create')
                  <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}"> Create New Role</a>
                  @endcan
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url ('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#"><i data-feather="users"></i></a></li>
                        <li class="breadcrumb-item active">Roles Management</li>
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
                              <table class="table table-bordernone" id="role_table">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Roles</th>
                                    <th class="text-center">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($roles as $key => $role)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td class="text-center">{{ $role->name }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-pill" role="group" >
                                              @can('role-edit')
                                                <a class="btn btn-warning btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                              @endcan
                                              @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                              @endcan
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
                    {!! $roles->render() !!}
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