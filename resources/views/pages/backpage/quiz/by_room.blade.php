@extends('layouts/backpage/base')
@section('title', 'Trivia Quiz')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" id="new-question">Add Question</a>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/rooms') }}">{{ $room->name }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">Trivia Quiz of {{ $room->name }}</a></li>
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
                                                <table class="table table-bordernone" id="question_table">
                                                    <thead>
                                                        <tr>
                                                            <th class="f-22">Question</th>
                                                            <th>Point</th>
                                                            <th>Time</th>
                                                            <th>Create By</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $key => $question)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-inline-block align-middle">
                                                                        @if ($question->image)
                                                                            <img id="preview"
                                                                                class="img-40 m-r-15 rounded-circle"
                                                                                src="{{ '/img/question/' . $question->image }}"
                                                                                alt="{{ $question->title }}"
                                                                                style="height: 40px">
                                                                        @else
                                                                            <img id="preview"
                                                                                src="https://via.placeholder.com/150"
                                                                                class="img-40 m-r-15 rounded-circle align-top hidden">
                                                                        @endif
                                                                        <div class="status-circle bg-primary"></div>
                                                                        {{ strip_tags($question->title) }}
                                                                    </div>
                                                                </td>
                                                                <td>{{ $question->point }}</td>
                                                                <td>{{ $question->time }} Minutes</td>

                                                                <td>
                                                                    <div class="d-inline-block">
                                                                        <span>{{ $user->name }}</span>
                                                                        <p class="font-roboto">
                                                                            {{ date('D d M Y', strtotime($question->updated_at)) }}
                                                                        </p>
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group btn-group-pill" role="group">
                                                                        <button class="btn btn-warning btn-sm edit-user"
                                                                            type="button"
                                                                            data-id="{{ $question->id }}">Edit</button>
                                                                        <button
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
    <div class="modal fade" id="ajax-question-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="questionModal"></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="questionForm" name="questionForm" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="question_id" id="question_id">
                        <input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <img class="img-80 rounded-circle" id="modal-preview"
                                    src="https://via.placeholder.com/150"><br><br>
                                <div class="upload-btn-wrapper">
                                    <button class="btn-upload">Upload file</button>
                                    <input id="image" type="file" name="image" accept="image/*" onchange="readURL(this);">
                                </div>
                                <input type="hidden" name="hidden_image" id="hidden_image">
                            </div>
                            <div class="col-md-10">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Pertanyaan</label>
                                        <textarea id="title" name="title" value="" class="summernote" rows="10" cols="50" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Poin</label>
                                        <input type="number" class="form-control" id="point" name="point"
                                            placeholder="Point" value="" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Waktu</label>
                                        <input type="number" class="form-control" id="time" name="time"
                                            placeholder="Waktu dalam menit" value="" required="">
                                    </div>
                                </div>
                                <hr>
                                <h6 class="text-center">Jawaban</h6>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label>Jawaban 1</label>
                                        <input type="text" class="form-control" id="a_1" name="a_1" placeholder="Jawaban 1" value="" required="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Apakah benar ?</label>
                                        <select class="form-control" id="correct_1" name="correct_1" required="">
                                            <option value="">Pilih</option>
                                            <option value="1">Benar</option>
                                            <option value="0">Salah</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Sort</label>
                                        <input type="number" class="form-control" id="sort_1" name="sort_1" placeholder="Sort" value="1" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label>Jawaban 2</label>
                                        <input type="text" class="form-control" id="a_2" name="a_2" placeholder="Jawaban 2" value="" required="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Apakah benar ?</label>
                                        <select class="form-control" id="correct_2" name="correct_2" required="">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Sort</label>
                                        <input type="number" class="form-control" id="sort_2" name="sort_2" placeholder="Sort" value="2" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label>Jawaban 3</label>
                                        <input type="text" class="form-control" id="a_3" name="a_3" placeholder="Jawaban 3" value="" required="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Apakah benar ?</label>
                                        <select class="form-control" id="correct_3" name="correct_3" required="">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Sort</label>
                                        <input type="number" class="form-control" id="sort_3" name="sort_3" placeholder="Sort" value="3" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label>Jawaban 4</label>
                                        <input type="text" class="form-control" id="a_4" name="a_4" placeholder="Jawaban 4" value="" required="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Apakah benar ?</label>
                                        <select class="form-control" id="correct_4" name="correct_4" required="">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Sort</label>
                                        <input type="number" class="form-control" id="sort_4" name="sort_4" placeholder="Sort" value="4" required="">
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

            $("#correct_1").change(function () {
                var val = $(this).val();
                if (val == "0") {
                    if ($('#a_2').val() !== "" ){
                        $("#correct_2").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_3').val() !== "" ){
                        $("#correct_3").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_4').val() !== "" ){
                        $("#correct_4").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                } else if (val == "1") {
                    if ($('#a_2').val() !== "" ){
                        $("#correct_2").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_3').val() !== "" ){
                        $("#correct_3").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_4').val() !== "" ){
                        $("#correct_4").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                }
            });

            $("#correct_2").change(function () {
                var val = $(this).val();
                if (val == "0") {
                    if ($('#a_1').val() !== "" ){
                        $("#correct_1").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_3').val() !== "" ){
                        $("#correct_3").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_4').val() !== "" ){
                        $("#correct_4").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                } else if (val == "1") {
                    if ($('#a_1').val() !== "" ){
                        $("#correct_1").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_3').val() !== "" ){
                        $("#correct_3").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_4').val() !== "" ){
                        $("#correct_4").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                }
            });

            $("#correct_3").change(function () {
                var val = $(this).val();
                if (val == "0") {
                    if ($('#a_1').val() !== "" ){
                        $("#correct_1").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_2').val() !== "" ){
                        $("#correct_2").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_4').val() !== "" ){
                        $("#correct_4").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                } else if (val == "1") {
                    if ($('#a_1').val() !== "" ){
                        $("#correct_1").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_2').val() !== "" ){
                        $("#correct_2").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_4').val() !== "" ){
                        $("#correct_4").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                }
            });

            $("#correct_4").change(function () {
                var val = $(this).val();
                if (val == "0") {
                    if ($('#a_1').val() !== "" ){
                        $("#correct_1").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_2').val() !== "" ){
                        $("#correct_2").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                    if ($('#a_3').val() !== "" ){
                        $("#correct_3").html("<option value=''>Pilih</option><option value='1'>Benar</option><option value='0'>Salah</option>");
                    }
                } else if (val == "1") {
                    if ($('#a_1').val() !== "" ){
                        $("#correct_1").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_2').val() !== "" ){
                        $("#correct_2").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                    if ($('#a_3').val() !== "" ){
                        $("#correct_3").html("<option value='0'>Salah</option><option value='1'>Benar</option>");
                    }
                }
            });



            $('#title').summernote({
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#new-question').click(function() {
                $('#btn-save').val("create-user");
                $('#user_id').val('');
                $("#title").text('');
                $("#point").text('');
                $("#time").text('');
                $('#questionForm').trigger("reset");
                $('#questionModal').html("Buat pertanyaan baru");
                $('#ajax-question-modal').modal('show');
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
                        $('#questionModal').html("Edit User");
                        $('#btn-save').val("edit-user");
                        $('#ajax-question-modal').modal('show');
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
                                    $("#question_table").load(window.location.href + " #question_table");
                                    swal("Success", "This user has been delete", "success");
                                } else {
                                    $("#question_table").load(window.location.href + " #question_table");
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

        $('body').on('submit', '#questionForm', function(e) {
            e.preventDefault();
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending Data..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/trivia-quiz/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#questionForm').trigger("reset");
                    $('#ajax-question-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    $("#title").text('');
                    $("#point").text('');
                    $("#time").text('');
                    $("#question_table").load(window.location.href + " #question_table");
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
