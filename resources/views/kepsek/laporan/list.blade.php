@extends('layouts.sbadmin')
@section('title', 'Home')
@section('content')
<div class="card">
    <div class="card-header"> {{ __('List Laporan') }} </div>

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

        <table id="data-guru-kurikulum" class="display" style="wid100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Mapel</th>
                    <th>RPP</th>
                    <th>Embed Video</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$dt->nip}}</td>
                        <td>{{$dt->mapel}}</td>
                        <td><a href="{{asset('rpp/'.$dt->rpp)}}" class="ml-2" target="_blank">pdf</a></td>
                        <td><a target="_blank" href="{{$dt->embed}}">Link</a></td>
                        <td>{{$dt->status}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
