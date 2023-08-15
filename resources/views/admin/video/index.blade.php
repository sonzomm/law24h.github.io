@extends('admin')
@section('content')
    <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Nội Dung</th>
            <th>Video</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($video as $video)
            <tr>
                <td>{{$video->id}}</td>
                <td>{{$video->name}}</td>
                <td>{{$video->noidung}}</td>
                <td>
                    <video controls width="300px" height="400px" >
                        <source src="{{asset('/upload/'.$video->video)}}"   type="video/mp4">
                        video
                    </video>
                </td>

                <td>
                    <a href="{{route('video.edit',$video->id)}}">
                        <button   class="btn btn-warning ">Edit</button>
                    </a>
                </td>
                <td>
                    <form action="{{route('video.destroy',$video->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
@push('js')
    <script>
        $(document).ready(function (){
            $('#user').addClass('menu-open');
            $('#user_index').addClass('active');
            $('#user_manage').addClass('active');
        });
    </script>
@endpush
