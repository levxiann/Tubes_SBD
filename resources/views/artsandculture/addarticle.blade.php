@extends('artsandculture.layouts.main')

@section('main')

<div class="row ms-2 mt-2">
    <form action="{{ url('/articles/add/'.$idmed) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset style="border: 2px solid black; border-radius:20px; padding:10px">
            <legend align="center" style="font-family: fantasy;">Tambah Artikel</legend>
        <div class="form-group mb-3">
            <label class="label" for="titleArtikel">Judul Artikel</label>
            <input id="titleArtikel" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Article title" value="{{ old('title') }}" autocomplete="name" autofocus>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="credit">Credit</label>
            <input id="credit" name="credit" type="text" class="form-control @error('credit') is-invalid @enderror" placeholder="credit" value="{{ old('credit') }}" autocomplete="name" autofocus>
            @error('credit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="writer">Penulis</label>
            <input id="writer" name="writer" type="text" class="form-control @error('writer') is-invalid @enderror" placeholder="writer" value="{{ old('writer') }}" autocomplete="name" autofocus>
            @error('writer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="contentEdit">Konten</label>
            <textarea id="contentEdit" name="content" type="text" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="content" value="" autocomplete="name" autofocus>{{ old('content') }}</textarea>
            @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="image">Background</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <button type="submit" name="tambahArtikel" class="btn btn-success">Save</button>
            <a href="{{url('/medium/'.$idmed)}}" class="btn btn-danger">Cancel</a>
        </div>
        </fieldset>
    </form>
</div>

{{-- script ckeditor --}}
<script>
    CKEDITOR.replace('contentEdit', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection