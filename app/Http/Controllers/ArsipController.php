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
		$this->middleware(\App\Http\Middleware\HanyaAdmin::class)->except('index', 'unduh');
	}

	private function unggahBerkas(Request $request, String $jenis_dokumen)
	{
		$nama_berkas = $request->berkas->getClientOriginalName();
		$berkas_array = explode('.', $nama_berkas);
		$ekstensi_berkas = end($berkas_array);
		$path = $request->file('berkas')->store(\Auth::user()->email.'/'.$jenis_dokumen.'/'.$request->tanggal.'/'.$nama_berkas, 'dropbox');
		return [
			'nama_berkas'			=> $nama_berkas,
			'ekstensi_berkas'		=> $ekstensi_berkas,
			'berkas'				=> $path,
		];
	}

	public function index($jenis_dokumen)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		$data = Arsip::where('jenis_dokumen_id', $jd->id);
		if(\Auth::user()->role == 'admin')
			$data = $data->where('kantor_id', \Auth::user()->kantor->id);
		$data = $data->orderBy('tanggal', 'DESC')->get();
		return view('stisla.arsip.index', [
			'data'				=> $data,
			'active'			=> 'arsip/'.$jenis_dokumen,
			'jenis_dokumen'		=> $jenis_dokumen,
			'action_tambah'		=> route('arsip.create', [$jenis_dokumen]),
		]);
	}

	public function create($jenis_dokumen)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		return view('stisla.arsip.tambah', [
			'action'		=> route('arsip.store', [$jenis_dokumen]),
			'active'		=> 'arsip/'.$jenis_dokumen,
			'modul'			=> $this->modul,
			'jenis_dokumen'	=> $jenis_dokumen,
		]);
	}

	public function store($jenis_dokumen, Request $request)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		$rules = [
			'no_surat'		=> 'required',
			'judul_surat'	=> 'required',
			'tanggal'		=> 'required',
			'berkas'		=> 'required|file',
		];
		if($jenis_dokumen == 'surat_masuk'){
			$rules['pengirim'] = 'required';
		}
		else if($jenis_dokumen == 'surat_keluar'){
			$rules['penerima'] = 'required';
		}
		else if($jenis_dokumen == 'pegawai'){
			$rules['pegawai'] = 'required';
		}
		$request->validate($rules);
		$data = [
			'no_surat'			=> $request->no_surat,
			'judul_surat'		=> $request->judul_surat,
			'jenis_dokumen_id'	=> $jd->id,
			'pengirim'			=> $request->pengirim,
			'penerima'			=> $request->penerima,
			'tanggal'			=> $request->tanggal,
			'kantor_id'			=> \Auth::user()->kantor->id,
			'disk'				=> config('dropbox.active'),
		];

		$data = array_merge($data, $this->unggahBerkas($request, $jenis_dokumen));

		Arsip::create($data);

		$modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();

		return redirect()->back()->with('success_msg', $modul->label.' berhasil disimpan');
	}

	public function unduh($jenis_dokumen, Arsip $arsip)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		if($arsip->jenis_dokumen_id != $jd->id)
			abort(404);
		if(\Auth::user()->role == 'admin'){
			if(\Auth::user()->kantor->id != $arsip->kantor_id){
				abort(404);
			}
		}
		if($arsip->berkas)
			return \Storage::disk(config('dropbox.active'))->download($arsip->berkas, $arsip->nama_berkas);
		abort(404);
	}
	

	public function preview($jenis_dokumen, Arsip $arsip)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		if($arsip->jenis_dokumen_id != $jd->id)
			abort(404);
		if(\Auth::user()->role == 'admin'){
			if(\Auth::user()->kantor->id != $arsip->kantor_id){
				abort(404);
			}
		}
		if($arsip->berkas){
			
			$berkas = file_get_contents(\Storage::disk('dropbox')->url($arsip->berkas));
			\Storage::put('haha.pdf', $berkas);
			return response()->file(
				storage_path('app\\haha.pdf')
			)->deleteFileAfterSend(true);
			return \Storage::download('haha.pdf');

			return response()->redirectTo(\Storage::disk('dropbox')->url($arsip->berkas));
			return response()->file(
				$arsip->berkas
			);
			$data = \Storage::disk('dropbox')->url($arsip->berkas);
			header('Content-Type: application/pdf');
			header('location: '.$data);
			exit;
			return $data;
			return \Storage::disk('dropbox')->download($arsip->berkas);
		}
		abort(404);
	}

	public function edit($jenis_dokumen, Arsip $arsip)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		if($arsip->jenis_dokumen_id != $jd->id)
			abort(404);
		if(\Auth::user()->role == 'admin'){
			if(\Auth::user()->kantor->id != $arsip->kantor_id){
				abort(404);
			}
		}
		return view('stisla.arsip.tambah', [
			'action'		=> route('arsip.update', ['jenis_dokumen'=>$jenis_dokumen, 'arsip'=>$arsip->id]),
			'active'		=> 'arsip/'.$jenis_dokumen,
			'jenis_dokumen'	=> $jenis_dokumen,
			'd'				=> $arsip,
		]);
	}

	public function update(Request $request, $jenis_dokumen, Arsip $arsip)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		if($arsip->jenis_dokumen_id != $jd->id)
			abort(404);
		if(\Auth::user()->role == 'admin'){
			if(\Auth::user()->kantor->id != $arsip->kantor_id){
				abort(404);
			}
		}
		$rules = [
			'no_surat'		=> 'required',
			'judul_surat'	=> 'required',
			'tanggal'		=> 'required',
			'berkas'		=> 'nullable|file',
		];
		if($jenis_dokumen == 'surat_masuk'){
			$rules['pengirim'] = 'required';
		}
		else if($jenis_dokumen == 'surat_keluar'){
			$rules['penerima'] = 'required';
		}
		else if($jenis_dokumen == 'pegawai'){
			$rules['pegawai'] = 'required';
		}
		$request->validate($rules);
		$data = [
			'no_surat'			=> $request->no_surat,
			'judul_surat'		=> $request->judul_surat,
			'jenis_dokumen_id'	=> $jd->id,
			'pengirim'			=> $request->pengirim,
			'penerima'			=> $request->penerima,
			'tanggal'			=> $request->tanggal,
			'kantor_id'			=> \Auth::user()->kantor->id,
		];
		if($request->file('berkas')){
			$data = array_merge($data, $this->unggahBerkas($request, $jenis_dokumen));
			if(\Storage::disk('dropbox')->exists($arsip->berkas)){
				\Storage::disk('dropbox')->delete($arsip->berkas);
			}
		}

		$arsip->update($data);

		$modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();

		return redirect()->back()->with('success_msg', $modul->label.' berhasil diperbarui');
	}

	public function destroy($jenis_dokumen, Arsip $arsip)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		if($arsip->jenis_dokumen_id != $jd->id)
			abort(404);
		if(\Auth::user()->role == 'admin'){
			if(\Auth::user()->kantor->id != $arsip->kantor_id){
				abort(404);
			}
		}
		if($arsip->berkas){
			if(\Storage::disk('dropbox')->exists($arsip->berkas)){
				\Storage::disk('dropbox')->delete($arsip->berkas);
			}
		}
		$arsip->delete();
		$modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();
		return redirect()->back()->with('success_msg', $modul->label.' berhasil dihapus');
	}

}
