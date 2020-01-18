<?php

namespace App\Http\Controllers\Stisla;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contoh;

class ContohController extends Controller
{

	private $modul;

	public function __construct()
	{
		$this->modul = \App\Models\Modul::where('nama', 'contoh')->first();
	}

	public function index()
	{
		return view('stisla.contoh.index', [
			'title'				=> $this->modul->label,
			'data'				=> Contoh::all(),
			'active'			=> 'contoh.index',
			'modul'				=> $this->modul,
			'action_tambah'		=> route('contoh.create'),
		]);
	}

	public function create()
	{
		return view('stisla.contoh.tambah', [
			'title'			=> $this->modul->label.' Baru',
			'action'		=> route('contoh.store'),
			'active'		=> 'contoh.index',
			'modul'			=> $this->modul,
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'ini_text'			=> 'required',
			'ini_email'			=> 'required',
			'ini_number'		=> 'required',
			'ini_datepicker'	=> 'required',
			'ini_gambar'		=> 'required',
			'ini_excel'			=> 'required',
			'ini_file'			=> 'required',
			'ini_textarea'		=> 'required',
			'ini_select'		=> 'required',
			'ini_select2'		=> 'required',
			'ini_password'		=> 'required',
		]);

		$data = [
			'ini_text'			=> $request->ini_text,
			'ini_email'			=> $request->ini_email,
			'ini_number'		=> $request->ini_number,
			'ini_datepicker'	=> $request->ini_datepicker,
			'ini_gambar'		=> $request->file('ini_gambar')->store('public/ini_gambar'),
			'ini_excel'			=> $request->file('ini_excel')->store('public/ini_excel'),
			'ini_file'			=> $request->file('ini_file')->store('public/ini_file'),
			'ini_textarea'		=> $request->ini_textarea,
			'ini_select'		=> $request->ini_select,
			'ini_select2'		=> $request->ini_select2,
			'ini_password'		=> bcrypt($request->ini_password),
		];

		Contoh::create($data);

		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil disimpan');
	}

	public function show(Contoh $contoh)
	{
		return view('stisla.contoh.tambah', [
			'title'			=> $this->modul->label.' Detail',
			'action'		=> null,
			'active'		=> 'contoh.index',
			'modul'			=> $this->modul,
			'd'				=> $contoh,
		]);
	}

	public function edit(Contoh $contoh)
	{
		return view('stisla.contoh.tambah', [
			'title'			=> $this->modul->label.' Ubah',
			'action'		=> route('contoh.update', ['contoh'=>$contoh->id]),
			'active'		=> 'contoh.index',
			'modul'			=> $this->modul,
			'd'				=> $contoh,
		]);
	}

	public function update(Request $request, Contoh $contoh)
	{
		$request->validate([
			'ini_text'			=> 'required',
			'ini_email'			=> 'required',
			'ini_datepicker'	=> 'required',
			'ini_gambar'		=> 'required',
			'ini_excel'			=> 'required',
			'ini_file'			=> 'required',
			'ini_textarea'		=> 'required',
			'ini_select'		=> 'required',
			'ini_select2'		=> 'required',
			'ini_password'		=> 'required',
		]);

		$data = [
			'ini_text'			=> $request->ini_text,
			'ini_email'			=> $request->ini_email,
			'ini_datepicker'	=> $request->ini_datepicker,
			'ini_gambar'		=> $request->file('ini_gambar')->store('public/ini_gambar'),
			'ini_excel'			=> $request->file('ini_excel')->store('public/ini_excel'),
			'ini_file'			=> $request->file('ini_file')->store('public/ini_file'),
			'ini_textarea'		=> $request->ini_textarea,
			'ini_select'		=> $request->ini_select,
			'ini_select2'		=> $request->ini_select2,
			'ini_password'		=> $request->ini_password,
		];

		$contoh->update($data);

		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil diperbarui');
	}

	public function destroy(Contoh $contoh)
	{
		$contoh->delete();
		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil dihapus');
	}

}
