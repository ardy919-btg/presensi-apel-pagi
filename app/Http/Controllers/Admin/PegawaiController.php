<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Data Pegawai
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = User::where('role', 'pegawai');

        /*
        |--------------------------------------------------------------------------
        | Search Nama / NIP
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'nip',
                    'like',
                    '%' . $search . '%'
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Filter Bidang
        |--------------------------------------------------------------------------
        */

        if ($request->filled('bidang')) {

            $query->where(
                'bidang',
                $request->bidang
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $pegawai = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Daftar Bidang Untuk Filter
        |--------------------------------------------------------------------------
        */

        $bidangList = User::where(
                'role',
                'pegawai'
            )
            ->whereNotNull('bidang')
            ->where('bidang', '!=', '')
            ->distinct()
            ->orderBy('bidang')
            ->pluck('bidang');


        return view(
            'admin.pegawai.index',
            compact(
                'pegawai',
                'bidangList'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Form Tambah Pegawai
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.pegawai.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Pegawai
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nip' => [
                'required',
                'string',
                'max:30',
                'unique:users,nip',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Email Tidak Wajib
            |--------------------------------------------------------------------------
            */

            'email' => [
                'nullable',
                'email',
                'unique:users,email',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:255',
            ],

            'bidang' => [
                'required',
                'string',
                'max:255',
            ],

            'pangkat_golongan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'jenis_kelamin' => [
                'nullable',
                Rule::in([
                    'Laki-Laki',
                    'Perempuan',
                ]),
            ],

            'pendidikan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'pendidikan_detail' => [
                'nullable',
                'string',
                'max:255',
            ],

            'golongan_darah' => [
                'nullable',
                Rule::in([
                    'A',
                    'B',
                    'AB',
                    'O',
                ]),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        User::create([

            'nip' => $request->nip,

            'name' => $request->name,

            'email' => $request->filled('email')
                ? $request->email
                : null,

            'jabatan' => $request->jabatan,

            'bidang' => $request->bidang,

            'pangkat_golongan' => $request->pangkat_golongan,

            'tanggal_lahir' => $request->tanggal_lahir,

            'jenis_kelamin' => $request->jenis_kelamin,

            'pendidikan' => $request->pendidikan,

            'pendidikan_detail' => $request->pendidikan_detail,

            'golongan_darah' => $request->golongan_darah,

            'role' => 'pegawai',

            'status' => 'aktif',

            'password' => Hash::make(
                $request->password
            ),
        ]);


        return redirect()
            ->route('admin.pegawai.index')
            ->with(
                'success',
                'Data pegawai berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Form Edit Pegawai
    |--------------------------------------------------------------------------
    */

    public function edit(User $pegawai)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Yang Diedit Adalah Pegawai
        |--------------------------------------------------------------------------
        */

        if ($pegawai->role !== 'pegawai') {
            abort(403);
        }


        return view(
            'admin.pegawai.edit',
            compact('pegawai')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Pegawai
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        User $pegawai
    ) {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Yang Diupdate Adalah Pegawai
        |--------------------------------------------------------------------------
        */

        if ($pegawai->role !== 'pegawai') {
            abort(403);
        }


        $request->validate([

            'nip' => [
                'required',
                'string',
                'max:30',

                Rule::unique(
                    'users',
                    'nip'
                )->ignore(
                    $pegawai->id
                ),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Email Tidak Wajib
            |--------------------------------------------------------------------------
            */

            'email' => [
                'nullable',
                'email',

                Rule::unique(
                    'users',
                    'email'
                )->ignore(
                    $pegawai->id
                ),
            ],

            'jabatan' => [
                'required',
                'string',
                'max:255',
            ],

            'bidang' => [
                'required',
                'string',
                'max:255',
            ],

            'pangkat_golongan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'jenis_kelamin' => [
                'nullable',
                Rule::in([
                    'Laki-Laki',
                    'Perempuan',
                ]),
            ],

            'pendidikan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'pendidikan_detail' => [
                'nullable',
                'string',
                'max:255',
            ],

            'golongan_darah' => [
                'nullable',
                Rule::in([
                    'A',
                    'B',
                    'AB',
                    'O',
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    'aktif',
                    'nonaktif',
                ]),
            ],

            /*
            |--------------------------------------------------------------------------
            | Password Boleh Dikosongkan
            |--------------------------------------------------------------------------
            */

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Data Yang Akan Diupdate
        |--------------------------------------------------------------------------
        */

        $data = [

            'nip' => $request->nip,

            'name' => $request->name,

            'email' => $request->filled('email')
                ? $request->email
                : null,

            'jabatan' => $request->jabatan,

            'bidang' => $request->bidang,

            'pangkat_golongan' => $request->pangkat_golongan,

            'tanggal_lahir' => $request->tanggal_lahir,

            'jenis_kelamin' => $request->jenis_kelamin,

            'pendidikan' => $request->pendidikan,

            'pendidikan_detail' => $request->pendidikan_detail,

            'golongan_darah' => $request->golongan_darah,

            'status' => $request->status,
        ];


        /*
        |--------------------------------------------------------------------------
        | Update Password Hanya Jika Diisi
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {

            $data['password'] = Hash::make(
                $request->password
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan Perubahan
        |--------------------------------------------------------------------------
        */

        $pegawai->update(
            $data
        );


        return redirect()
            ->route('admin.pegawai.index')
            ->with(
                'success',
                'Data pegawai berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Pegawai
    |--------------------------------------------------------------------------
    */

    public function destroy(User $pegawai)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Yang Dihapus Adalah Pegawai
        |--------------------------------------------------------------------------
        */

        if ($pegawai->role !== 'pegawai') {
            abort(403);
        }


        $pegawai->delete();


        return redirect()
            ->route('admin.pegawai.index')
            ->with(
                'success',
                'Data pegawai berhasil dihapus.'
            );
    }


    /**
     * Reset password pegawai ke password default.
     */
    public function resetPassword(User $pegawai)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Yang Direset Adalah Pegawai
        |--------------------------------------------------------------------------
        */

        if ($pegawai->role !== 'pegawai') {
            abort(403);
        }


        $pegawai->update([
            'password' => User::passwordDefault(),
            'must_change_password' => true,
        ]);


        return redirect()
            ->route('admin.pegawai.index')
            ->with(
                'success',
                'Password ' . $pegawai->name . ' berhasil direset ke password default.'
            );
    }
}