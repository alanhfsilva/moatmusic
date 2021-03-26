@extends('layouts.app',["current" => 'albums'])

@section('content')
<form action="{{ url('/albums') }}" class="form-horizontal" id="frmAlbum" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ old('id', $album->id ?? '') }}">
    <h5>Create new album</h5>
    <div class="row mb-3">
    <label for="artistName" class="col-sm-2 col-form-label">Artist</label>
    <div class="col-sm-10">
        <select name="artist" id="artistName" class="form-control" disabled required><option value="">Loading...</select>
    </div>
    </div>
    <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Album Name</label>
    <div class="col-sm-10">
        <input type="text" id="albumName" name="name" class="form-control" placeholder="Album name" value="{{ old('id', $album->name ?? '') }}" required>
    </div>
    </div>
    <div class="row mb-3">
    <label for="albumYear" class="col-sm-2 col-form-label">Year</label>
    <div class="col-sm-10">
        <input type="number" id="albumYear" min="0" step="1" name="year" min="1900" max="{{date('Y')}}" class="form-control" placeholder="Album year" value="{{ old('id', $album->year ?? date('Y')) }}">
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ url('/albums') }}" class="btn btn-secondary btn-cancel">Cancel</a>
</form>
@endsection

@section('javascript')
<script type="text/javascript">
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            populateArtistSelect();
            $('#frmAlbum').submit(function (e){
                e.preventDefault();
                submitAlbumData();
            });
        }
    };

    function populateArtistSelect() {
        var url = "{{ route('api.artists.json') }}";
        var sl_artist = $('#artistName');
        var artist = "{{ old('id', $album->artist ?? '0') }}";
        $.getJSON(url, function(data) {
            sl_artist.html('').prop('disabled','');
            for(i=0;i<data.length;i++) {
                option = '<option value="'+data[i].name+'"'+(artist == data[i].name ? 'selected' : '')+'>'+data[i].name+'</option>';
                sl_artist.append(option);
            }
        });
    }

    function submitAlbumData() {
        var params = $('#frmAlbum').serialize();
        @if(isset($album->id))
        $.ajax({
            type: 'PUT',
            url: '{{ route("albums.update",$album->id) }}',
            dataType: 'json',
            data: params
        }).then(data => {
            console.log('Album updated.');
            window.location.replace("{{url('albums')}}");
        })
        .catch(error => {
            var xhr = $.ajax();
            console.log(xhr);
            console.log(error);
        });
        @else
        $.post('{{route('albums.store')}}',params,function(data){
            console.log("Album created");
            window.location.replace("{{url('albums')}}");
        });
        @endif
    }
</script>
@endsection