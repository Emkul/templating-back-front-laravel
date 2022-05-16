<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class kategoriController extends Controller
{

    public function __construct( Request $request )
    {        
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        


        return view('kategori.index', [
            'title' => 'Daftar Kategori',
            'kategoris' => DB::table('kategoris')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create', [
            'kategori' => new Kategori(),
            'submit' => 'Create',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'nama_kategori' => ['required']
        ]);

        DB::table('kategoris')->insert([
            'user_id' => Auth::id(),
            'nama_kategori' => $request->nama_kategori,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        return redirect('kategori')->withStatus(__('sukses ditambahkan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($kategori)
    {

        return view('kategori.show', [
            'kategori' => DB::table('kategoris')->find($kategori),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {

        return view('kategori.edit', [
            'kategori' => DB::table('kategoris')->where('id', $kategori->id)->get()->first(),
            'submit' => 'Update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kategori)
    {
        DB::table('kategoris')->where('id', $kategori)->update(['nama_kategori' => $request->nama_kategori]);
        return redirect('/kategori')->withStatus(__('kategori successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($kategori)
    {

        DB::table('kategoris')->where('id', $kategori)->delete();
        return redirect('/kategori')->withStatus(__('Terhapus'));;
    }

    public function status($kategori)
    {
        $change = '';
        $status = DB::table('kategoris')->where('id', $kategori)->get('status')->first();
        if ($status->status == 'Y') {
            $change = 'N';
        } else {
            $change = 'Y';
        }

        DB::table('kategoris')->where('id', $kategori)->update(['status' => $change]);
        return redirect('/kategori');
    }
}
