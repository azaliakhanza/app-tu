<?php

namespace App\Http\Controllers;

use App\Models\letter_type;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letter = letter_type::all();
        return view('data-klasifikasi-surat.index', compact('letter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-klasifikasi-surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodeSurat' => 'required|max:6',
            'klasifikasiSurat' => 'required|string',
        ]);


        $letter = Letter_type::count();
        Letter_type::create([
            'letter_code' => $request->kodeSurat . '-' . $letter,
            'name_type' => $request->klasifikasiSurat,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(letter_type $letter_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $letter = letter_type::find($id);
        return view('data-klasifikasi-surat.edit', compact('letter'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
        ]);

       $klasifikasiData = [
            'letter_code' => $request -> letter_code,
            'name_type' => $request -> name_type,
        ];

        letter_type::where('id', $id)->update($klasifikasiData);

        return redirect()->route('data-klasifikasi-surat.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        letter_type::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
