@extends('layouts.app',["current" => 'albums'])

@section('content')
<div class="card">
    <div class="card-header">{{ __('Albums') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if(!$albums->isEmpty())
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="50%">Album Name</th>
                    <th width="20%">Artist</th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $album)
                <tr>
                    <td>{{$album->id}}</td>
                    <td>{{$album->name}}</td>
                    <td>{{$album->artist}}</td>
                    <td>
                        <a href="{{ url('/albums') }}/{{$album->id}}/edit" class="btn btn-sm btn-primary">Edit</a>
                        @if (Auth::user()->role == 'admin')
                        <a href="javascript:;" onclick="deleteAlbum({{$album->id}})" class="btn btn-sm btn-danger">Delete</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else 
            @include('components.noresults') 
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ url('/albums/create') }}" class="btn btn-primary btn-sm" role="button">+ Add new album</a>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    function deleteAlbum(id) {
        if(confirm('Delete this album?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('/albums')}}/"+id,
                type: 'DELETE',
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });
        }        
    }
</script>
@endsection