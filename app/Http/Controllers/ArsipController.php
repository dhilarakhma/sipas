<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Arsip;

class ArsipController extends Controller
{

	private $modul;

	public function __construct()
	{
		// $this->modul = \App\Models\Modul::where('nama', $this->jenis_dokumen)->first();
	}

	public function index($jenis_dokumen)
	{
		return view('stisla.arsip.index', [
			'data'				=> Arsip::all(),
			'active'			=> 'arsip.index',
			'jenis_dokumen'		=> $jenis_dokumen,
			'action_tambah'		=> route('arsip.create', [$jenis_dokumen]),
		]);
	}

	public function create()
	{
		return view('stisla.arsip.tambah', [
			'title'			=> $this->modul->label.' Baru',
			'action'		=> route('arsip.store'),
			'active'		=> 'arsip.index',
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

		Arsip::create($data);

		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil disimpan');
	}

	public function show(Arsip $Arsip)
	{
		return view('stisla.arsip.tambah', [
			'title'			=> $this->modul->label.' Detail',
			'action'		=> null,
			'active'		=> 'arsip.index',
			'modul'			=> $this->modul,
			'd'				=> $Arsip,
		]);
	}

	public function edit(Arsip $Arsip)
	{
		return view('stisla.arsip.tambah', [
			'title'			=> $this->modul->label.' Ubah',
			'action'		=> route('arsip.update', ['Arsip'=>$Arsip->id]),
			'active'		=> 'arsip.index',
			'modul'			=> $this->modul,
			'd'				=> $Arsip,
		]);
	}

	public function update(Request $request, Arsip $Arsip)
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

		$Arsip->update($data);

		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil diperbarui');
	}

	public function destroy(Arsip $Arsip)
	{
		$Arsip->delete();
		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil dihapus');
	}

}
