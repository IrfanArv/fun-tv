
@extends('layouts/backpage/base')
@section('title', 'Add New Roles')
@section('content')
<div class="page-body">
	<div class="container-fluid">
	    <div class="page-title">
		    <div class="row">
                <div class="col-lg-6">
                    <h3>Add New Role</h3>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url ('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{url ('/dashboard/roles')}}"><i data-feather="users"></i></a></li>
                        <li class="breadcrumb-item active">Add new role</li>
                    </ol>
                </div>
	        </div>
	    </div>
    </div>
    <div class="container-fluid">
        @if (count($errors) > 0)
        <div class="alert alert-danger dark alert-dismissible fade show" role="alert" id="success-alert">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST','class' => 'theme-form')) !!}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label pb-0">Permission</label>
                                <div class="col-sm-9">
                                    <div class="form-group m-checkbox-inline mb-0">
                                        <input class="checkbox_animated" type="checkbox" id="checkAll">
                                        <label>Check All</label><hr>
                                        @foreach($permission as $value)
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'checkbox_animated')) }}
                                            <label>{{ $value->name }}</label><br/>
                                        @endforeach
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="form-group row text-right">
                                <label class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">
                                    <a class="btn btn-danger btn-sm" href="{{ route('roles.index') }}">Back </a>
                                    <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                </div>
                            </div>
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

      </div>
</div>
<script>
        
    $(document).ready(function() {
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
   
</script>

@endsection