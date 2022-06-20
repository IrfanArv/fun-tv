@extends('layouts/backpage/base')
@section('title', 'Edit User')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Edit User</h3>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/users') }}"><i
                                        data-feather="users"></i></a></li>
                            <li class="breadcrumb-item active">Edit user</li>
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
            <div class="edit-profile">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row mb-2">
                                    <div class="col-auto">
                                        @if ($user->image)
                                            <img class="img-70 rounded-circle" id="modal-preview"
                                                src="{{ '/img/user/' . $user->image }}" alt="{{ $user->name }}"><br><br>
                                        @else
                                            <img class="img-70 rounded-circle" id="modal-preview"
                                                src="https://via.placeholder.com/150"><br><br>
                                        @endif
                                        <div class="upload-btn-wrapper">
                                            <button class="btn-upload">Change Avatar</button>
                                            <input id="image" type="file" name="image" accept="image/*"
                                                onchange="readURL(this);">
                                        </div>
                                        <input type="hidden" name="hidden_image" id="hidden_image">
                                    </div>
                                    <div class="col-auto" style="margin-top: 10px;">
                                        <h3 class="mb-1 name" id="show-nama" value=""></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Full Name</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'id' => 'name']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Confirm Password</label>
                                    <div class="col-sm-8">
                                        {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Roles</label>
                                    <div class="col-sm-8">
                                        {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                                    </div>
                                </div>
                                <div class="form-group row text-right">
                                    <label class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <a class="btn btn-danger btn-sm" href="{{ route('users.index') }}">Back </a>
                                        <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {!! Form::close() !!}
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
            $("#name").keyup(function() {
                var currentText = $(this).val();
                $(".name").text(currentText);
            });
            var nama = $('#name').val();
            $('#show-nama').html(nama);
        });

        function readURL(input, id) {
            id = id || '#modal-preview';
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(id).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                $('#modal-preview').removeClass('hidden');
                $('#start').hide();
            }
        }
    </script>

@endsection
