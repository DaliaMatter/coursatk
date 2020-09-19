@extends('layouts.student')

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
    <table class="table table-striped h5 table-bordered">
    <thead class="thead-dark">
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
                
                @if($enrolled->find($course->id))
                    <div class="action-form">
                        <form action="{{route('drop')}}" method="POST" style="display:inline-block">
                            <!-- <input type="submit" value="Delete" class="btn btn-danger btn-group"> -->
                            {!! Form::button ('<i class="material-icons delete">&#xE872;</i>' ,['type' => 'submit' , 'class' => 'deletebtn']) !!}
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                        </form>
                    </div>
                @else
                    <div class="action-form">
                        <form action="{{ route('store')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            {!! Form::button ('<i class="material-icons edit">&#xE254;</i>' ,['type' => 'submit' , 'class' => 'deletebtn']) !!}
                        </form>
                    </div>
                @endif               
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endisset
    
@endsection