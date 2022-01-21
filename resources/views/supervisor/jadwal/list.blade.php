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
                    <th>Nama Target</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$dt->nip}}</td>
                        <td>{{$dt->target->name}}</td>
                        <td>{{$dt->tanggal_supervisi}}</td>
                        <td>{{$dt->jam_dari}} -  {{$dt->jam_sampai}}</td>
                        <td>{{ $dt->doc->status}}</td>
                        <td>
                            @if ($dt->doc->catatan != NULL)

                            {{ $dt->doc->catatan }}
                            @else
                                Tidak ada catatan...
                            @endif
                        </td>
                        <td>
                            <button type="button" class="text-white btn btn-info" data-toggle="modal" data-target="{{'#cekStatusModal'.$dt->id}}">
                                Lihat Dokumen
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="{{'cekStatusModal'.$dt->id}}" tabindex="-1" role="dialog" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{'cekStatusModal'.$dt->id}}">Dokumen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-2">
                                            <label for="dokumen">RPP :

                                                @if ($dt->cek)
                                                <a href="{{asset('rpp/'.$dt->cek->rpp)}}" class="ml-2" target="_blank">link</a>
                                                @else
                                                RPP Kosong!
                                                @endif
                                            </label>
                                        </div>
                                        <div class="row">
                                            <label for="dokumen">Embed Video :

                                                @if ($dt->cek)
                                                    <a href="{{$dt->cek->embed}}" class="ml-2" target="_blank">link</a>
                                                @else
                                                    Embed Kosong!
                                                @endif
                                            </label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        @if ($dt->doc->status != 'lulus')

                                            <button type="button" class="text-white btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="{{'#lulusModal'.$dt->id}}">
                                                Lulus
                                            </button>
                                        @endif
                                        @if ($dt->doc->status != 'tidak lulus')
                                            <button type="button" class="text-white btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="{{'#tidakLulusModal'.$dt->id}}">
                                                Tidak Lulus
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="modal fade" id="{{'lulusModal'.$dt->id}}" tabindex="-1" role="dialog" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{'lulusModal'.$dt->id}}">Catatan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="" method="post" action="{{ route('supervisor.nilai.post', $dt->doc->id)}}">
                                        @csrf
                                        @method('patch')
                                            <div class="modal-body">
                                                <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="4"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Kirim</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                    </form>
                                </div>
                                </div>
                            </div>

                            <div class="modal fade" id="{{'tidakLulusModal'.$dt->id}}" tabindex="-1" role="dialog" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{'tidakLulusModal'.$dt->id}}">Catatan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="" method="post" action="{{ route('supervisor.nilai.tidaklulus.post', $dt->doc->id)}}">
                                        @csrf
                                        @method('patch')
                                            <div class="modal-body">
                                                <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="4"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Kirim</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                    </form>

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
