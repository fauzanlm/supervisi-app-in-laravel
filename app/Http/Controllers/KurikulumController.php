<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Supervisi;
use App\Models\Documents;
use Hash;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::all();
        return view('kurikulum.home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function laporan()
    {
        $data = Documents::all();
        return view('kurikulum.laporan.home', compact('data'));
    }

    public function jadwal()
    {
        $data = Jadwal::all();
        return view('kurikulum.jadwal.list', compact('data'));
    }

    public function jadwalAdd()
    {
        $dataGuru = User::where("role", "=", "guru", "and")->where("supervisor", "=", '0')->get();
        $dataSupervisor = User::where('supervisor', '=', '1')->get();
        return view('kurikulum.jadwal.add', compact('dataGuru', 'dataSupervisor'));
    }

    public function jadwalAddPost(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'id_supervisor' => 'required',
            'tanggal_supervisi' => 'required',
            'jam_dari' => 'required',
            'jam_sampai' => 'required',
        ]);


        $jadwal = Jadwal::create($request->all());

        // Supervisi::create([
        //     'nip' => $request->nip ,
        //     'id_supervisor' => $request->id_supervisor,
        //     'id_jadwal' => $jadwal->id,
        //     'id_document' => '0'
        // ]);
        return redirect()->route('kurikulum.jadwal');
    }



    public function jadwalDelete($id)
    {
        Jadwal::destroy($id);
        return redirect()->route('home');
    }

    public function tosupervisor($id)
    {
        User::find($id)->update([
            'supervisor' => 1
        ]);

        return redirect()->back();
    }

    public function deletesupervisor($id)
    {
        User::find($id)->update([
            'supervisor' => 0
        ]);

        return redirect()->back();
    }

    public function guruAdd()
    {
        return view('kurikulum.guru.add');
    }

    public function guruAddPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'nip' => 'required',
            'email' => 'required',
        ]);

        User::create([
            'name' => $request['name'],
            'alamat' => $request['alamat'],
            'nip' => $request['nip'],
            'email' => $request['email'],
            'password' => Hash::make($request['nip']),
        ]);

        return redirect()->route('kurikulum.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
