
@extends('layouts/backpage/base')
@section('title', 'Stream Rooms')
@section('content') 
<div class="page-body">
	<div class="container-fluid">
	    <div class="page-title">
		    <div class="row">
                <div class="col-lg-6">
                    <a class="btn btn-success btn-sm" href="{{ route('rooms.create') }}"> Add stream room</a>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url ('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="#">Stream room</a></li>
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
                                    <th class="f-22">Name</th>
                                    <th>Players</th>
                                    <th>Trivia Quiz</th>
                                    <th>Create By</th>
                                    <th class="text-center">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($data as $key => $room)
                                      <tr>
                                          <td>
                                            {{$room->name}}
                                            <br>
                                            {{$room->stream_key}}
                                          </td>
                                          @php
                                            $playerList = App\Models\Player::where('room_id', '=', $room->id)->get();
                                            $playerTotal = $playerList->count();
                                          @endphp
                                            <td><a href="{{ route('players_by_room',$room->id) }}" target="_blank" class="btn btn-sm btn-outline-success">({{$playerTotal}}) Players</a> </td>
                                          @php
                                            $questionList = App\Models\Question::where('room_id', '=', $room->id)->get();
                                            $questionTotal = $questionList->count();
                                          @endphp
                                          <td><a href="{{ route('quiz_by_room',$room->id) }}" target="_blank" class="btn btn-sm btn-outline-success">({{$questionTotal}}) Questions</a> </td>
                                          <td>
                                              <div class="d-inline-block"><span>{{ $user->name}}</span>
                                              <p class="font-roboto">{{ date('D d M Y', strtotime($room->updated_at))  }}</p>
                                          </td>
                                          <td class="text-center">
                                              <div class="btn-group btn-group-pill" role="group" >
                                                <a class="btn btn-warning btn-sm" href="{{ route('rooms.edit',$room->id) }}">Edit</a>
                                                <button class="btn btn-info btn-sm" type="button">
                                                  {{$room->status == 1 ? "Disable" : "Enable"}}
                                                </button>
                                                {!! Form::open(['method' => 'DELETE','route' => ['rooms.destroy', $room->id],'style'=>'display:inline']) !!}
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