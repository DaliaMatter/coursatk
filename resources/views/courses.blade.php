@extends('layouts.admin')

@section('title')
    Courses Control Panel
@endsection

@section('control-panel')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add New Course</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adding New Course</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('courses.store') }}">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="title">Course Name</label>
                        <input type="text" class="form-control" name='name' id="name">
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="title">Course Estmated Time</label>
                          <input type="number" class="form-control" name='estmated_time' id="estmated_time">
                        </div>
                      </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="title">Course Info.</label>
                          <textarea type="text" class="form-control" name='info' id="info" rows="3"></textarea>
                        </div>
                      </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                </form>    
                    </div>
            
        </div>
    </div>
</div>
</div>

@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @isset($courses)
    <table class="table table-striped h5">
    <thead>
        <tr>
            <th scope="col">Course Name</th>
            <th scope="col">Course Estmated Time</th>
            <th scope="col">Course Info</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $courses as $course)
        <tr>
            <td>{{ $course->name}} </td>
            <td>{{ $course->estmated_time}} </td>
            <td><p>{{ $course->info}}</p></td>
            <td>
                <div class="btn-toolbar">
                    <!-- <button class="btn btn-primary btn-group mr-4" data-toggle="modal" data-target="#update-user-modal-{{ $course->id }}">Update</button> -->
                    <i class="material-icons edit" data-toggle="modal" data-target="#update-user-modal-{{ $course->id }}">&#xE254;</i>
                    <div class="modal fade update-user-modal" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true" id="update-user-modal-{{ $course->id }}">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-username">Update Course</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('courses.update',$course)}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group col-md-6">
                                            <label for="name">Courses Name</label>
                                            <input type="text" required class="form-control"  name='name'
                                                id="name" value="{{$course->name}}">
                                        </div>
                                        <br>
                                        <div class="form-group col-md-6">
                                            <label for="info">Courses Info.</label>
                                            <textarea required class="form-control" rows="3" name='info'
                                                id="info" value="{{$course->info}}">{{$course->info}}</textarea>
                                        </div>
                                        <br>
                                        <div class="form-group col-md-6">
                                            <label for="estmated_time">Courses Estmated Time</label>
                                            <input type="number" required class="form-control" name='estmated_time'
                                                id="name" value="{{$course->estmated_time}}">
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <form action="{{route('courses.destroy',$course)}}" method="POST" style="display:inline-block">
                        <!-- <input type="submit" value="Delete" class="btn btn-danger btn-group"> -->
                        {!! Form::button ('<i class="material-icons delete">&#xE872;</i>' ,['type' => 'submit' , 'class' => 'deletebtn']) !!}
                        @csrf
                        @method('DELETE')
                    </form>
                    </div>    
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endisset
    
@endsection