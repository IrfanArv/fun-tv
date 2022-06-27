@extends('layouts/backpage/base')
@section('title', 'Players')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" id="new-player">Add Player</a>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">Players</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row starter-main">
                <div class="col-xl-9 xl-100 box-col-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="best-seller-table responsive-tbl">
                                        <div class="item">
                                            <div class="table-responsive product-list">
                                                <table class="table table-bordernone" id="player_table">
                                                    <thead>
                                                        <tr>
                                                            <th class="f-22">Name</th>
                                                            <th>Email</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $key => $player)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-inline-block align-middle">
                                                                        <img id="preview"
                                                                            src="https://via.placeholder.com/150"
                                                                            class="img-40 m-r-15 rounded-circle align-top hidden">
                                                                        <div class="status-circle bg-primary"></div>
                                                                        {{ strip_tags($player->name) }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{ $player->email }}
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group btn-group-pill" role="group">
                                                                        <button class="btn btn-warning btn-sm edit-user"
                                                                            type="button"
                                                                            data-id="{{ $player->id }}">Edit</button>
                                                                        <button onclick="DeleteUser({{ $player->id }});"
                                                                            class="delete btn btn-danger btn-sm"
                                                                            type="button">Delete</button>
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
                                <div class="p-20">
                                    {{ $data->links('vendor.pagination.simple-bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="ajax-player-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="playerModal"></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="playerForm" name="playerForm" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="player_id" id="player_id">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Full Name" value="" maxlength="50" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" value="" maxlength="50" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm-password"
                                            name="confirm-password" placeholder="Confirm Password" value="" maxlength="50"
                                            required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary btn-sm" type="submit" id="btn-save" value="create">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        var SITEURL = '{{ URL::to('') }}';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#new-player').click(function() {
                $('#btn-save').val("create-user");
                $('#user_id').val('');
                $("#name").text('');
                $("#email").text('');
                $('#playerForm').trigger("reset");
                $('#playerModal').html("Add New Player");
                $('#ajax-player-modal').modal('show');
                $('#modal-preview').attr('src', 'https://via.placeholder.com/350');
            });
            $('body').on('click', '.edit-user', function() {
                var user_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: SITEURL + "/dashboard/users/edit/" + user_id,
                    success: function(data) {
                        $('#title-error').hide();
                        $('#url-error').hide();
                        $('#description-error').hide();
                        $('#playerModal').html("Edit User");
                        $('#btn-save').val("edit-user");
                        $('#ajax-player-modal').modal('show');
                        $('#user_id').val(data.id);
                        $('#name').val(data.name);
                        $('#jabatan').val(data.jabatan);
                        $('#email').val(data.email);
                        $('#password').val(data.password);
                        $('#show-nama').html(data.name);
                        $('#show-jabatan').html(data.jabatan);
                        $('#modal-preview').attr('alt', 'No image available');
                        if (data.image) {
                            $('#modal-preview').attr('src', '{{ URL::to('/img/user') }}' +
                                '/' + data.image);
                            $('#hidden_image').attr('src', '{{ URL::to('/img/user') }}' +
                                '/' + data.image);
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            });
        });

        function DeleteUser(user_id) {
            swal({
                    title: "Delete user",
                    text: "Are you sure to delete this user ?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-success",
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Delete",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "GET",
                            url: SITEURL + "/dashboard/users/delete/" + user_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#player_table").load(window.location.href + " #player_table");
                                    swal("Success", "This user has been delete", "success");
                                } else {
                                    $("#player_table").load(window.location.href + " #player_table");
                                    swal("Success", "This user has been delete", "success");
                                }
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }

                        });
                    } else {
                        swal("Cancel", "This user cancelled to delete", "error");
                    }
                });
        }

        $('body').on('submit', '#playerForm', function(e) {
            e.preventDefault();
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending Data..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/players/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#playerForm').trigger("reset");
                    $('#ajax-player-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    $("#player_table").load(window.location.href + " #player_table");
                    swal("Good job!", "", "success");
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
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
