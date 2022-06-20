@extends('layouts/backpage/base')
@section('title', 'Edit Stream Room')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Edit Stream Room</h3>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/rooms') }}"><i
                                        data-feather="tv"></i></a></li>
                            <li class="breadcrumb-item active">Edit Stream Room</li>
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
                        {!! Form::model($room, ['method' => 'PATCH', 'route' => ['rooms.update', $room->id], 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">YT Stream Key</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('stream_key', null, ['placeholder' => 'Youtube Stream Key', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('status', ['1' => 'Active', '0' => 'Suspensed'], '1', ['class' => 'form-control', 'size' => '1']) !!}
                                    </div>
                                </div>

                                <div class="form-group row text-right">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <a class="btn btn-danger btn-sm" href="{{ route('rooms.index') }}">Back </a>
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
        });
    </script>

@endsection
