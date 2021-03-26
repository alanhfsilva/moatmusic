@extends('layouts.app',["current" => 'albums'])

@section('content')
<form action="@if(isset($album->id)){{ route("albums.update",$album->id) }}@else{{route('albums.store')}}@endif" class="form-horizontal" id="frmAlbum" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ old('id', $album->id ?? '') }}">
    <h5>Create new album</h5>
    <div class="row mb-3">
    <label for="artistName" class="col-sm-2 col-form-label">Artist</label>
    <div class="col-sm-10">
        <select name="artist" id="artistName" class="form-control{{ ($errors->has('artist')) ? ' is-invalid' : ''}}" disabled required><option value="">Loading...</option>
        </select>
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
    </div>
    <div class="row mb-3">
    <label for="albumName" class="col-sm-2 col-form-label">Album Name</label>
    <div class="col-sm-10">
        <input type="text" id="albumName" name="name" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : ''}}" placeholder="Album name" value="{{ old('name', $album->name ?? '') }}" required>
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
    </div>
    <div class="row mb-3">
    <label for="albumYear" class="col-sm-2 col-form-label">Year</label>
    <div class="col-sm-10">
        <input type="number" id="albumYear" min="0" step="1" name="year" min="1900" max="{{date('Y')}}" class="form-control{{ ($errors->has('year')) ? ' is-invalid' : ''}}" placeholder="Album year" value="{{ old('year', $album->year ?? date('Y')) }}" required>
        @if ($errors->has('year'))
            <div class="invalid-feedback">
                {{ $errors->first('year') }}
            </div>
        @endif
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
</script>
@endsection