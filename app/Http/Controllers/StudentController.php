<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentController extends Controller
{
    // Tampilkan semua data mahasiswa
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Tampilkan form tambah mahasiswa
    public function create()
    {
        return view('students.create');
    }

    // Simpan data mahasiswa baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hitung usia mahasiswa berdasarkan tanggal lahir
        $tanggalLahir = Carbon::parse($request->tanggal_lahir);
        $usia = Carbon::now()->diffInYears($tanggalLahir);

        // Validasi usia minimal 17 tahun
        if ($usia < 17) {
            return back()->withErrors(['tanggal_lahir' => 'Mahasiswa harus berusia minimal 17 tahun pada tahun 2024.'])->withInput();
        }

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/foto', 'public');
        }

        // Simpan data mahasiswa
        Student::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
        }

        // Tampilkan form edit mahasiswa
        public function edit(Student $student)
        {
            return view('students.edit', compact('student'));
        }

        // Update data mahasiswa ke database
        public function update(Request $request, Student $student)
        {
        // Validasi input
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hitung usia mahasiswa berdasarkan tanggal lahir
        $tanggalLahir = Carbon::parse($request->tanggal_lahir);
        $usia = Carbon::now()->diffInYears($tanggalLahir);

        // Validasi usia minimal 17 tahun
        if ($usia < 17) {
            return back()->withErrors(['tanggal_lahir' => 'Mahasiswa harus berusia minimal 17 tahun pada tahun 2024.'])->withInput();
        }

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/foto', 'public');
            $student->foto = $fotoPath;
        }

        // Update data mahasiswa
        $student->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto' => $student->foto,
        ]);

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil diperbarui.');
        }

        // Hapus data mahasiswa
        public function destroy(Student $student)
        {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil dihapus.');
        }
}
