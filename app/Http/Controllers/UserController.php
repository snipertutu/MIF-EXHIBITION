<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'mahasiswa')->get();
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    return '<button type="button" class="btn btn-icons btn-rounded btn-danger">
                            <i class="mdi mdi-archive"></i>
                            </button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.tables.Mahasiswa');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh pengguna
        $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'angkatan' => 'required',
        ]);

        try {
            // Simpan data mahasiswa ke dalam database
            User::create([
                'nim' => $request->nim,
                'name' => $request->name,
                'angkatan' => $request->angkatan,
            ]);

            // Berikan respons sukses jika penyimpanan berhasil
            return response()->json(['success' => 'Data mahasiswa berhasil ditambahkan.']);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Mengirimkan data mahasiswa dalam format JSON
        return response()->json($mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validasi data yang dikirim dari formulir edit
        $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'angkatan' => 'required|numeric',
        ]);

        // Mengambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($request->id);

        // Memperbarui data mahasiswa dengan data yang dikirim dari formulir edit
        $mahasiswa->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'angkatan' => $request->angkatan,
        ]);

        // Mengirimkan respons berhasil
        return response()->json(['message' => 'Data mahasiswa berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Validasi request
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        try {
            // Ambil ID pengguna dari permintaan
            $userId = $request->input('id');

            // Hapus pengguna dari database
            User::destroy($userId);

            // Berhasil menghapus, kembalikan respons berhasil
            return response()->json(['success' => 'Pengguna berhasil dihapus.']);
        } catch (\Exception $e) {
            // Tangani kesalahan
            // Misalnya, log pesan kesalahan
            \Log::error($e->getMessage());
            // Kembalikan respons dengan pesan kesalahan yang sesuai
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus pengguna.'], 500);
        }
    }
}
