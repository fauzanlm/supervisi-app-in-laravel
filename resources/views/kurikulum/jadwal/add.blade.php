@extends('layouts.sbadmin')
@section('title', 'Tambah Jadwal')
@section('content')
<div class="card">
    <div class="card-header">{{ __('Tambah Jadwal Supervisi') }}</div>

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

        <form method="POST" action="{{ route('kurikulum.jadwal.add.post') }}">
            @csrf

            <div class="row mb-3">
                <label for="nip" class="col-md-4 col-form-label text-md-start">Target Supervisi</label>
                <div class="col-md-8 ">
                    <select class="form-control" name="nip" id="nip">
                        <option value="" selected disabled>Pilih...</option>
                        @foreach ($dataGuru as $item)
                            <option value="{{$item->nip}}" {{old('nip') == $item->nip ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="id_supervisor" class="col-md-4 col-form-label text-md-start">Supervisor</label>
                <div class="col-md-8 ">
                    <select class="form-control" name="id_supervisor" id="id_supervisor">
                        <option value="" selected disabled>Pilih...</option>
                        @foreach ($dataSupervisor as $item)
                            <option value="{{$item->nip}}" {{old('id_supervisor') == $item->nip ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('id_supervisor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal_supervisi" class="col-md-4 col-form-label text-md-start">{{ __('Tanggal') }}</label>

                <div class="col-md-8">
                    <input id="d" type="date" class="form-control @error('tanggal_supervisi') is-invalid @enderror" name="tanggal_supervisi" value="{{ old('tanggal_supervisi') }}" required autocomplete="tanggal_supervisi" autofocus>

                    @error('tanggal_supervisi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="jam_dari" class="col-md-4 col-form-label text-md-start">{{ __('Jam Mulai') }}</label>

                <div class="col-md-8">
                    <input id="jam_dari" type="time" class="form-control @error('jam_dari') is-invalid @enderror" name="jam_dari" value="{{ old('jam_dari') }}" required autocomplete="jam_dari">

                    @error('jam_dari')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="jam_sampai" class="col-md-4 col-form-label text-md-start">{{ __('Jam Selesai') }}</label>

                <div class="col-md-8">
                    <input id="jam_sampai" type="time" class="form-control @error('jam_sampai') is-invalid @enderror" name="jam_sampai" value="{{ old('jam_sampai') }}" required autocomplete="jam_sampai">

                    @error('jam_sampai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('Kirim') }}
                    </button>

        </form>

    </div>
</div>
@endsection
