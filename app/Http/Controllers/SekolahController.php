<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SekolahController extends Controller
{
    public function index()
    {
        $nilais = Nilai::latest()->get();
        $nilais = $nilais->map(function (Nilai $nilai) {
            $nilai->siswa = $nilai->siswa;
            return $nilai;
        });
        return Inertia::render('nilai/Index', compact('nilais'));
    }

    public function createsiswa()
    {
        return Inertia::render('nilai/CreateSiswa', []);
    }
    public function storesiswa(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|numeric|min:1|max:6',
        ]);

        Siswa::create($data);

        return redirect()->route('nilai.index')->with('message', 'Siswa berhasil ditambahkan');
    }

    public function create()
    {
        $siswas = Siswa::latest()->get();
        return Inertia::render('nilai/Create', compact('siswas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|numeric',
            'kelas' => 'required|numeric|min:1|max:6',
            'mapel' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        Nilai::create([
            'siswa_id'=> $request->input('siswa_id'),
            'kelas'=> $request->input('kelas'),
            'mapel'=> $request->input('mapel'),
            'nilai'=> $request->input('nilai'),
        ]);

        return redirect()->route('nilai.index')->with('message', 'Nilai Berhasil ditambahkan');
    }

    public function edit(Nilai $nilai)
    {
        return Inertia::render('nilai/Edit', compact('nilai'));
    }


    public function update(Request $request, Nilai $nilai){
        $request->validate([
            'kelas'=>'required|numeric|min:1|max:6',
            'mapel'=>'required|string|max:255',
            'nilai'=>'required|numeric|min:0|max:100',
        ]);
        $nilai->update([
            'kelas'=> $request->input('kelas'),
            'mapel'=> $request->input('mapel'),
            'nilai'=> $request->input('nilai'),
        ]);

        return redirect()->route('nilai.index')->with('message','nilai berhasil diupdate');
    }

    public function destroy(Nilai $nilai){
        $nilai->delete();
        return redirect()->route('nilai.index')->with('message','nilai berhasil dihapus');
    }
}
