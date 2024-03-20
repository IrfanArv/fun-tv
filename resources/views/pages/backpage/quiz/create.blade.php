@extends('layouts/backpage/base')
@section('title', 'Add New Client')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Add Client</h3>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/client') }}">Client</a></li>
                            <li class="breadcrumb-item active">Add new client</li>
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
                        {!! Form::open(['route' => 'client.store', 'method' => 'POST', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row mb-2">
                                    <div class="col-auto">
                                        <img class="img-80 rounded-circle" id="modal-preview"
                                            src="https://via.placeholder.com/150"><br><br>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn-upload">Upload Logo</button>
                                            <input id="image" type="file" name="logo" accept="image/*"
                                                onchange="readURL(this);">
                                        </div>
                                        <input type="hidden" name="hidden_image" id="hidden_image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Client Name</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ['placeholder' => 'Client Name', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">About</label>
                                    <div class="col-sm-10">
                                        <textarea id="about" name="about" value="" class="summernote" rows="10" cols="50"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('status', ['Y' => 'Active', 'N' => 'Suspensed'], 'Y', [
                                            'class' => 'form-control',
                                            'size' => '1',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row text-right">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <a class="btn btn-danger btn-sm" href="{{ route('client.index') }}">Back </a>
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

            $('#about').summernote({
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
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
