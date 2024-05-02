<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class UploadDataController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);
    
        try {
            $file = $request->file('file');
    
            // Simpan file ke dalam folder penyimpanan tertentu
            $path = $file->store('file', 'public');
    
            // Pesan debug sebelum proses
            \Log::info('File uploaded successfully');
    
            $extension = $file->getClientOriginalExtension();
            
            if ($extension == 'csv') {
                // Jika file adalah CSV, maka baca datanya dan simpan ke dalam database
                $csvData = array_map('str_getcsv', file($file));
                
                foreach ($csvData as $row) {
                    User::create([
                        'nim' => $row[0],
                        'name' => $row[1],
                        'angkatan' => $row[3],
                    ]);
                }
            } else {
                // Jika bukan CSV, maka gunakan proses impor dengan library Excel
                Excel::import(new UserImport, storage_path('app/public/' . $path));
            }
    
            // Pesan debug setelah proses
            \Log::info('Data imported successfully');
    
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini
            // Misalnya, log pesan kesalahan
            \Log::error($e->getMessage());
            // Kembalikan respons dengan pesan kesalahan yang sesuai
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
    
}
