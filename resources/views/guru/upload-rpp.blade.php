@extends('layouts.sbadmin')
@section('title', 'Upload RPP')
@section('content')
<div class="card">
    <div class="card-header">{{ __('Upload RPP') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('msg'))
            <div class="alert alert-danger" role="alert">
                {{ session('msg') }}
            </div>
        @endif

        <form method="POST" action="{{ route('guru.upload-rpp.post') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="nip" value="{{ Auth::user()->nip }}">

            <div class="row mb-3">
                <label for="mapel" class="col-md-4 col-form-label text-md-end">{{ __('Mapel') }}</label>

                <div class="col-md-8">
                    <input id="mapel" type="text" class="form-control @error('mapel') is-invalid @enderror" name="mapel" value="{{ old('mapel') }}"  autocomplete="mapel" autofocus>

                    @error('mapel')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="rpp" class="col-md-4 col-form-label text-md-end">{{ __('RPP') }}</label>

                <div class="col-md-8">
                    <input id="rpp" type="file" class="form-control @error('rpp') is-invalid @enderror" name="rpp" value="{{ old('rpp') }}"  autocomplete="rpp" autofocus>

                    @error('rpp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="embed" class="col-md-4 col-form-label text-md-end">{{ __('Embed Video Link') }}</label>

                <div class="col-md-8">
                    <input id="embed" type="url" class="form-control @error('embed') is-invalid @enderror" name="embed" value="{{ old('embed') }}"  autocomplete="embed">

                    @error('embed')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Upload') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
