@extends('layouts.sbadmin')
@section('title', 'Jadwal Supervisi')
@section('content')
<div class="card">
    <div class="card-header"> {{ __('Jadwal Supervisi Anda') }}</div>

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
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$dt->nip}}</td>
                        <td>{{$dt->tanggal_supervisi}}</td>
                        <td>{{$dt->jam_dari}} -  {{$dt->jam_sampai}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cekStatusModal">
                                Cek Status
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="cekStatusModal" tabindex="-1" role="dialog" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cekStatusModalLabel">Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($dt->cek)
                                            abc
                                        @else
                                            def
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-info">Save changes</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
