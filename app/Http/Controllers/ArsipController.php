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
		$this->middleware(\App\Http\Middleware\HanyaAdmin::class)->except('index', 'unduh', 'laporan', 'laporanPdf');
	}

	private function unggahBerkas(Request $request, String $jenis_dokumen)
	{
		$nama_berkas = $request->berkas->getClientOriginalName();
		$berkas_array = explode('.', $nama_berkas);
		$ekstensi_berkas = end($berkas_array);
		$path = $request->file('berkas')->store(\Auth::user()->email.'/'.$jenis_dokumen.'/'.$request->tanggal.'/'.$nama_berkas, config('dropbox.active'));
		return [
			'nama_berkas'			=> $nama_berkas,
			'ekstensi_berkas'		=> $ekstensi_berkas,
			'berkas'				=> $path,
		];
	}

	public function index($jenis_dokumen, Request $request)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		$data = Arsip::where('jenis_dokumen_id', $jd->id);
		if(\Auth::user()->role == 'admin')
			$data = $data->where('kantor_id', \Auth::user()->kantor->id);
		$tahun = $request->query('tahun', date('Y'));
		if($tahun)
			$data = $data->whereYear('tanggal', $tahun)->orderBy('tanggal', 'DESC')->get();
		else
			$data = collect([]);
		$tahun = \DB::table('arsip')->select(\DB::raw('year(tanggal) as tahun'));
		if(\Auth::user()->role == 'admin')
			$tahun = $tahun->where('kantor_id', \Auth::user()->kantor->id);
		$tahun = $tahun->where('jenis_dokumen_id', $jd->id)
		->get();
		$tahun = collect($tahun)->pluck('tahun', 'tahun')->all();
		return view('stisla.arsip.index', [
			'data'				=> $data,
			'active'			=> 'arsip/'.$jenis_dokumen,
			'jenis_dokumen'		=> $jenis_dokumen,
			'action_tambah'		=> route('arsip.create', [$jenis_dokumen]),
			'action_laporan'	=> route('arsip.laporan', [$jenis_dokumen]),
			'action_laporan_pdf'=> route('arsip.laporan.pdf', [$jenis_dokumen]),
			'tahun'				=> $tahun,
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
			'maksud_surat'		=> $request->maksud_surat,
			'keterangan'		=> $request->keterangan,
			'acara'				=> $request->acara,
			'tempat'			=> $request->tempat,
			'pengundang'		=> $request->pengundang,
			'delegasi_hadir'	=> $request->delegasi_hadir,
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


	public function preview($jenis_dokumen, Arsip $arsip, Request $request)
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

		// if(env('IS_HEROKU', true))
		// 	return 'server tidak mendukung preview';

		if($arsip->berkas){

			if($arsip->ekstensi_berkas != 'pdf')
				return 'ekstensi berkas tidak didukung untuk preview';

			$berkas = file_get_contents(\Storage::disk(config('dropbox.active'))->url($arsip->berkas));
			$preview_file = 'public/'.\Auth::user()->email.'/preview.pdf';
			\Storage::put($preview_file, $berkas);

			$filename = 'preview.pdf';
			$headers = [
				'Content-Type' => 'application/pdf',
			    'Content-Disposition' => 'inline; filename="'.$filename.'"'
			];

			return response()->file(storage_path('app/'.$preview_file), $headers);

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
			'maksud_surat'		=> $request->maksud_surat,
			'keterangan'		=> $request->keterangan,
			'tanggal'			=> $request->tanggal,
			'kantor_id'			=> \Auth::user()->kantor->id,
			'acara'				=> $request->acara,
			'tempat'			=> $request->tempat,
			'pengundang'		=> $request->pengundang,
			'delegasi_hadir'	=> $request->delegasi_hadir,
		];
		if($request->file('berkas')){
			$data = array_merge($data, $this->unggahBerkas($request, $jenis_dokumen));
			if(\Storage::disk(config('dropbox.active'))->exists($arsip->berkas)){
				\Storage::disk(config('dropbox.active'))->delete($arsip->berkas);
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
			if(\Storage::disk(config('dropbox.active'))->exists($arsip->berkas)){
				\Storage::disk(config('dropbox.active'))->delete($arsip->berkas);
			}
		}
		$arsip->delete();
		$modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();
		return redirect()->back()->with('success_msg', $modul->label.' berhasil dihapus');
	}

	private function getData($jenis_dokumen, $request)
	{
		$jd = \App\JenisDokumen::where('route', $jenis_dokumen)->first();
		if(!$jd)
			abort(404);
		$tahun = $request->query('tahun');
		$data = Arsip::where('jenis_dokumen_id', $jd->id);
		if(\Auth::user()->role == 'admin')
		$data = $data->where('kantor_id', \Auth::user()->kantor->id);
		if($tahun)
			$data = $data->whereYear('tanggal', $tahun)->orderBy('tanggal', 'DESC')->get();
		else
			$data = collect([]);
		return [
			'data'=>$data,
			'jd'=>$jd,
			'jenis_dokumen'=>$jenis_dokumen,
		];
	}

	public function laporan($jenis_dokumen, Request $request)
	{
		if(!$request->query('tahun'))
			return 'Tidak ada data ditemukan';
		$ss = $this->getData($jenis_dokumen, $request);
		if(count($ss['data']) <= 0)
			return 'Tidak ada data ditemukan';
		return view('stisla.arsip.laporan', [
			'data'	=> $ss['data'],
			'jd'=>$ss['jd'],
			'jenis_dokumen'=>$ss['jenis_dokumen'],
			'tahun'=>$request->query('tahun'),
		]);
	}

	public function laporanPdf($jenis_dokumen, Request $request)
	{
		if(!$request->query('tahun'))
			return 'Tidak ada data ditemukan';
		$ukuran_kertas = \App\Models\Pengaturan::where('key', 'ukuran_kertas')->first()->value;
		if(count($ss['data']) <= 0)
			return 'Tidak ada data ditemukan';
		$layouts = \App\Models\Pengaturan::where('key', 'layouts')->first()->value;
		$ss = $this->getData($jenis_dokumen, $request);
		return \PDF::loadView('stisla.arsip.laporan', [
			'data'	=> $ss['data'],
			'jd'=>$ss['jd'],
			'jenis_dokumen'=>$ss['jenis_dokumen'],
			'tahun'=>$request->query('tahun'),
		])->setPaper($ukuran_kertas, $layouts)->download('laporan_'.$jenis_dokumen.'.pdf');
	}

}
