@extends('layouts.sbadmin')
@section('title', 'Home')
@section('content')
<div class="card">
    <div class="card-header"> {{ __('Data Guru') }} <a href="{{ route('kurikulum.guru.add') }}" class="btn btn-sm float-right btn-info ">Tambah Data</a></div>

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

        <table id="data-guru-kurikulum" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Supervisor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                        <td>{{$dt->nip}}</td>
                        <td>{{$dt->name}}</td>
                        <td>{{$dt->alamat}}</td>
                        <td>{{$dt->email}}</td>
                        <td>{{$dt->role}}</td>
                        <td>
                            @if ($dt->supervisor == 0)
                                <a href="{{ route('kurikulum.to.supervisor', $dt->id) }}" class="btn btn-sm btn-success">Active</a>
                            @else
                                <a href="{{ route('kurikulum.delete.supervisor', $dt->id) }}" class="btn btn-sm btn-danger">Deactive</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
