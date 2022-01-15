<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Documents;
use App\Models\Jadwal;

class GuruController extends Controller
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
        $data = Jadwal::where('nip', '=', Auth::user()->nip)->get();
        return view('guru.home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadRpp()
    {
        return view('guru.upload-rpp');
    }

    public function uploadRppPost( Request $request)
    {
        $request->validate([
            'rpp' => 'required|mimes:pdf|max:2048',
            'mapel' => 'required',
            'embed' => 'required',

        ]);

        $name = time().'.'. $request->file('rpp')->getClientOriginalName();
        $request->rpp->move(public_path('rpp'), $name);

        Documents::create([
            'nip' => $request->nip,
            'rpp' => $name,
            'mapel' => $request->mapel,
            'embed' => $request->embed,
        ]);


        return view('guru.upload-rpp');
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
