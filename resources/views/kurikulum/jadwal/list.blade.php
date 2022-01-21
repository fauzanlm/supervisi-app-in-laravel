@extends('layouts.sbadmin')
@section('title', 'Home')
@section('content')
<div class="card">
    <div class="card-header"> {{ __('Jadwal Supervisi') }} <a href="{{ route('kurikulum.jadwal.add') }}" class="btn btn-sm float-right btn-info ">Tambah Jadwal</a></div>

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
                    <th>Nama Guru</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Supervisor</th>
                    <th>Nama Supervisor</th>
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
                        <td>{{$dt->id_supervisor}}</td>
                        <td>{{ $dt->supervisor->name }}</td>
                        <td>
                            <div class="btn-group">


                                <a href="{{route('kurikulum.jadwal.delete', $dt->id)}}" class="btn btn-sm btn-block btn-danger" onclick="return confirm('yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
