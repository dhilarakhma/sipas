<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Arsip;
use App\Services\DropBoxService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class ArsipController extends Controller
{

    private $modul;

    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\OnlyAdmin::class)->except('index', 'unduh', 'laporan', 'laporanPdf', 'preview');
    }

    private function uploadFile(Request $request, String $jenis_dokumen)
    {
        $nama_berkas     = $request->berkas->getClientOriginalName();
        $berkas_array    = explode('.', $nama_berkas);
        $ekstensi_berkas = end($berkas_array);

        $path = Auth::user()->email . '/' . $jenis_dokumen . '/' . $request->tanggal;
        $realPath = $request->file('berkas')->getRealPath();


        $filename = $nama_berkas;
        $fromPath = $path . '/' . basename($realPath);
        $toPath   = $path . '/' . $filename;


        $fileArray    = explode('.', $nama_berkas);
        $ext = end($fileArray);
        $path            = Auth::user()->email . '/' . $jenis_dokumen . '/' . $request->tanggal . '/' . $nama_berkas;
        if (config('upload.vendor') == 'dropbox')
            $path            = $request->file('berkas')->store($path, config('dropbox.active'));
        else
            $path            = $request->file('berkas')->store($path);

        return [
            'nama_berkas'     => $filename,
            'ekstensi_berkas' => $ekstensi_berkas,
            'berkas'          => $path,
        ];
    }

    private function uploadFileLaravel9(Request $request, String $jenis_dokumen)
    {
        $filename       = $request->berkas->getClientOriginalName();
        $berkas_array   = explode('.', $filename);
        $ext            = end($berkas_array);
        $folder         = Auth::user()->email . '/' . $jenis_dokumen . '/' . $request->tanggal . '/' . $filename;
        $localPath      = $request->file('berkas')->store($folder);
        $fullLocalPath  = storage_path('app/' . $localPath);
        $randomFilename = basename($fullLocalPath);

        $isDropbox = config('upload.vendor') === 'dropbox';
        if ($isDropbox) {
            $dropbox = new DropBoxService;
            $dropbox->uploadFile($fullLocalPath, $folder);
        }

        return [
            'nama_berkas'     => $filename,
            'ekstensi_berkas' => $ext,
            'berkas'          => $isDropbox ? $folder . '/' . $randomFilename : $localPath,
        ];
    }

    public function index($jenis_dokumen, Request $request)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        $data = Arsip::where('jenis_dokumen_id', $jd->id);
        if (Auth::user()->role == 'admin')
            $data = $data->where('kantor_id', Auth::user()->kantor->id);
        $year = $request->query('tahun', date('Y'));
        $data = $data->whereYear('tanggal', $year)->orderBy('tanggal', 'DESC')->latest()->get();
        $year = DB::table('arsip')->select(DB::raw('year(tanggal) as tahun'));
        if (Auth::user()->role == 'admin')
            $year = $year->where('kantor_id', Auth::user()->kantor->id);
        $year = $year->where('jenis_dokumen_id', $jd->id)->get();
        $year = collect($year)->pluck('tahun', 'tahun')->all();

        return view('stisla.arsip.index', [
            'data'               => $data,
            'active'             => 'arsip/' . $jenis_dokumen,
            'jenis_dokumen'      => $jenis_dokumen,
            'action_tambah'      => route('arsip.create', [$jenis_dokumen]),
            'action_laporan'     => route('arsip.laporan', [$jenis_dokumen]),
            'action_laporan_pdf' => route('arsip.laporan.pdf', [$jenis_dokumen]),
            'tahun'              => $year,
        ]);
    }

    public function create($jenis_dokumen)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        return view('stisla.arsip.tambah', [
            'action'        => route('arsip.store', [$jenis_dokumen]),
            'active'        => 'arsip/' . $jenis_dokumen,
            'modul'         => $this->modul,
            'jenis_dokumen' => $jenis_dokumen,
        ]);
    }

    public function store($jenis_dokumen, Request $request)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        $rules = [
            'no_surat'    => 'required',
            'judul_surat' => 'required',
            'tanggal'     => 'required',
            'berkas'      => 'required|file',
        ];
        if ($jenis_dokumen == 'surat_masuk') {
            $rules['pengirim'] = 'required';
        } else if ($jenis_dokumen == 'surat_keluar') {
            $rules['penerima'] = 'required';
        } else if ($jenis_dokumen == 'pegawai') {
            $rules['pegawai'] = 'required';
        }
        $request->validate($rules);
        $data = [
            'no_surat'         => $request->no_surat,
            'judul_surat'      => $request->judul_surat,
            'jenis_dokumen_id' => $jd->id,
            'pengirim'         => $request->pengirim,
            'penerima'         => $request->penerima,
            'tanggal'          => $request->tanggal,
            'kantor_id'        => Auth::user()->kantor->id,
            'disk'             => config('dropbox.active') ?? 'dropbox',
            'maksud_surat'     => $request->maksud_surat,
            'keterangan'       => $request->keterangan,
            'acara'            => $request->acara,
            'tempat'           => $request->tempat,
            'pengundang'       => $request->pengundang,
            'delegasi_hadir'   => $request->delegasi_hadir,
        ];

        $data = array_merge($data, $this->uploadFileLaravel9($request, $jenis_dokumen));

        Arsip::create($data);

        $modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();

        return redirect()->back()->with('success_msg', $modul->label . ' berhasil disimpan');
    }

    public function unduh($jenis_dokumen, Arsip $arsip)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        if ($arsip->jenis_dokumen_id != $jd->id)
            abort(404);
        if (Auth::user()->role == 'admin') {
            if (Auth::user()->kantor->id != $arsip->kantor_id) {
                abort(404);
            }
        }
        if ($arsip->berkas) {
            // laravel 9
            if (config('upload.vendor') == 'dropbox') {
                $dropbox = new DropBoxService;
                $fullPath = $dropbox->download($arsip->berkas, $arsip->nama_berkas);
                return response()->download($fullPath)->deleteFileAfterSend(true);
            } else
                return Storage::download($arsip->berkas, $arsip->nama_berkas);

            // laravel 6
            if (config('upload.vendor') == 'dropbox')
                return Storage::disk(config('dropbox.active'))->download($arsip->berkas, $arsip->nama_berkas);
            else
                return Storage::download($arsip->berkas, $arsip->nama_berkas);
        }
        abort(404);
    }


    public function preview($jenis_dokumen, Arsip $arsip, Request $request)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        if ($arsip->jenis_dokumen_id != $jd->id)
            abort(404);
        if (Auth::user()->role == 'admin') {
            if (Auth::user()->kantor->id != $arsip->kantor_id) {
                abort(404);
            }
        }

        if ($arsip->berkas) {

            if (!in_array($arsip->ekstensi_berkas, ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'json', 'webm', 'webp'])) {
                return 'ekstensi berkas tidak didukung untuk preview';
            }

            $isLocal = config('upload.vendor') == 'local';

            // laravel 9
            if (config('upload.vendor') == 'dropbox') {
                $dropbox = new DropBoxService;
                $preview_file = $dropbox->download($arsip->berkas, $arsip->nama_berkas);
            }

            $filename = 'preview.' . $arsip->ekstensi_berkas;
            $headers = [
                'Content-Disposition' => 'inline; filename="' . $filename . '"'
            ];
            if ($arsip->ekstensi_berkas === 'pdf') {
                $headers['Content-Type'] = 'application/pdf';
            }

            // laravel 9
            return response()->file(
                $isLocal ? storage_path('app/' . $arsip->berkas) : $preview_file,
                $headers
            );

            // laravel 6
            return response()->file(
                $isLocal ? storage_path('app/' . $arsip->berkas) : storage_path('app/' . $preview_file),
                $headers
            );
        }
        abort(404);
    }

    public function edit($jenis_dokumen, Arsip $arsip)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        if ($arsip->jenis_dokumen_id != $jd->id)
            abort(404);
        if (Auth::user()->role == 'admin') {
            if (Auth::user()->kantor->id != $arsip->kantor_id) {
                abort(404);
            }
        }
        return view('stisla.arsip.tambah', [
            'action'        => route('arsip.update', ['jenis_dokumen' => $jenis_dokumen, 'arsip' => $arsip->id]),
            'active'        => 'arsip/' . $jenis_dokumen,
            'jenis_dokumen' => $jenis_dokumen,
            'd'             => $arsip,
        ]);
    }

    public function update(Request $request, $jenis_dokumen, Arsip $arsip)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        if ($arsip->jenis_dokumen_id != $jd->id)
            abort(404);
        if (Auth::user()->role == 'admin') {
            if (Auth::user()->kantor->id != $arsip->kantor_id) {
                abort(404);
            }
        }
        $rules = [
            'no_surat'    => 'required',
            'judul_surat' => 'required',
            'tanggal'     => 'required',
            'berkas'      => 'nullable|file',
        ];
        if ($jenis_dokumen == 'surat_masuk') {
            $rules['pengirim'] = 'required';
        } else if ($jenis_dokumen == 'surat_keluar') {
            $rules['penerima'] = 'required';
        } else if ($jenis_dokumen == 'pegawai') {
            $rules['pegawai'] = 'required';
        }
        $request->validate($rules);
        $data = [
            'no_surat'         => $request->no_surat,
            'judul_surat'      => $request->judul_surat,
            'jenis_dokumen_id' => $jd->id,
            'pengirim'         => $request->pengirim,
            'penerima'         => $request->penerima,
            'tanggal'          => $request->tanggal,
            'maksud_surat'     => $request->maksud_surat,
            'keterangan'       => $request->keterangan,
            'tanggal'          => $request->tanggal,
            'kantor_id'        => Auth::user()->kantor->id,
            'acara'            => $request->acara,
            'tempat'           => $request->tempat,
            'pengundang'       => $request->pengundang,
            'delegasi_hadir'   => $request->delegasi_hadir,
        ];
        if ($request->file('berkas')) {
            $data = array_merge($data, $this->unggahBerkas($request, $jenis_dokumen));
            $path = '/' . $arsip->berkas . '/' . $arsip->nama_berkas;
            Dropbox::files()->delete($path);
            $data = array_merge($data, $this->uploadFile($request, $jenis_dokumen));
            if (Storage::disk(config('dropbox.active'))->exists($arsip->berkas)) {
                Storage::disk(config('dropbox.active'))->delete($arsip->berkas);
            }
        }

        $arsip->update($data);

        $modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();

        return redirect()->back()->with('success_msg', $modul->label . ' berhasil diperbarui');
    }

    public function destroy($jenis_dokumen, Arsip $arsip)
    {
        $jd = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        if ($arsip->jenis_dokumen_id != $jd->id)
            abort(404);
        if (Auth::user()->role == 'admin') {
            if (Auth::user()->kantor->id != $arsip->kantor_id) {
                abort(404);
            }
        }
        if ($arsip->berkas) {
            $path = '/' . $arsip->berkas . '/' . $arsip->nama_berkas;
            Dropbox::files()->delete($path);
        }
        $arsip->delete();
        $modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();
        return redirect()->back()->with('success_msg', $modul->label . ' berhasil dihapus');
    }

    private function getData($jenis_dokumen, $request)
    {
        $jd    = \App\JenisDokumen::where('route', $jenis_dokumen)->firstOrFail();
        $tahun = $request->query('tahun');
        $data  = Arsip::where('jenis_dokumen_id', $jd->id);
        if (Auth::user()->role == 'admin')
            $data = $data->where('kantor_id', Auth::user()->kantor->id);
        if ($tahun)
            $data = $data->whereYear('tanggal', $tahun)->orderBy('tanggal', 'DESC')->get();
        else
            $data = collect([]);
        return [
            'data'          => $data,
            'jd'            => $jd,
            'jenis_dokumen' => $jenis_dokumen,
        ];
    }

    public function laporan($jenis_dokumen, Request $request)
    {
        if (!$request->query('tahun'))
            return 'Tidak ada data ditemukan';
        $ss = $this->getData($jenis_dokumen, $request);
        if (count($ss['data']) <= 0)
            return 'Tidak ada data ditemukan';
        return view('stisla.arsip.laporan', [
            'data'          => $ss['data'],
            'jd'            => $ss['jd'],
            'jenis_dokumen' => $ss['jenis_dokumen'],
            'tahun'         => $request->query('tahun'),
        ]);
    }

    public function laporanPdf($jenis_dokumen, Request $request)
    {
        if (!$request->query('tahun'))
            return 'Tidak ada data ditemukan';
        $ukuran_kertas = \App\Models\Pengaturan::where('key', 'ukuran_kertas')->first()->value;

        $layouts = \App\Models\Pengaturan::where('key', 'layouts')->first()->value;
        $ss = $this->getData($jenis_dokumen, $request);
        if (count($ss['data']) <= 0)
            return 'Tidak ada data ditemukan';
        return PDF::loadView('stisla.arsip.laporan', [
            'data'          => $ss['data'],
            'jd'            => $ss['jd'],
            'jenis_dokumen' => $ss['jenis_dokumen'],
            'tahun'         => $request->query('tahun'),
        ])->setPaper($ukuran_kertas, $layouts)->download('laporan_' . $jenis_dokumen . '.pdf');
    }
}
