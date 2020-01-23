<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kantor;

class KantorController extends Controller
{

	private $modul;

	public function __construct()
	{
		$this->modul = \App\Models\Modul::where('nama', 'kantor')->first();
	}

	public function index()
	{
		return view('stisla.kantor.index', [
			'data'				=> Kantor::all(),
			'active'			=> 'kantor.index',
			'action_tambah'		=> route('kantor.create'),
		]);
	}

	public function create()
	{
		return view('stisla.kantor.tambah', [
			'action'		=> route('kantor.store'),
			'active'		=> 'kantor.index',
			'modul'			=> $this->modul,
			'title'			=> $this->modul.' Baru'
		]);
	}

	public function store(Request $request)
	{
		$rules = [
			'kantor'		=> 'required',
			'nama_admin'	=> 'required',
			'email'			=> 'required|email|unique:users',
			'password'		=> 'required',
		];
		$request->validate($rules);
		$user_data = [
			'email'			=> $request->email,
			'nama'			=> $request->nama_admin,
			'password'		=> bcrypt($request->password),
			'avatar'        => asset('assets/img/avatar/avatar-1.png'),
		];
		$user = \App\User::create($user_data);
		$data = [
			'nama'				=> $request->kantor,
			'user_id'			=> $user->id
		];

		Kantor::create($data);

		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil disimpan');
	}

	public function edit(Kantor $kantor)
	{
		$kantor->load('user');
		return view('stisla.kantor.tambah', [
			'title'			=> $this->modul->label.' Ubah',
			'action'		=> route('kantor.update', ['kantor'=>$kantor->id]),
			'active'		=> 'kantor.index',
			'modul'			=> $this->modul,
			'd'				=> $kantor,
		]);
	}

	public function update(Request $request, Kantor $kantor)
	{
		$kantor->load('user');
		$rules = [
			'kantor'		=> 'required',
			'nama_admin'	=> 'required',
		];
		$user_data = [
			'nama'			=> $request->nama_admin,
		];
		if(!env('IS_HEROKU', true)){
			$rules['email']			= 'required|email|unique:users,email,'.$kantor->user->id;
			$rules['password']		= 'nullable';
			$user_data['email']		= $request->email;
			if($request->filled('password')){
				$user_data['password'] = bcrypt($request->password);
			}
		}
		$request->validate($rules);
		$kantor->user->update($user_data);
		$data = [
			'nama'				=> $request->kantor,
		];

		$kantor->update($data);

		return redirect()->back()->with('success_msg', $this->modul->label.' berhasil diperbarui');
	}

	public function destroy(Kantor $kantor)
	{
		if(!env('IS_HEROKU', true)){
			$kantor->delete();
			return redirect()->back()->with('success_msg', $this->modul->label.' berhasil dihapus');
		}	
		return redirect()->back()->with('error_msg', $this->modul->label.' gagal dihapus saat demo');
	}

}
