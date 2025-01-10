<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 100%; padding-left: 30px; padding-right: 30px;">
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="card shadow-lg rounded border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Data Mahasiswa Prodi Teknik Informatika</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-left mb-3">
                            <a href="{{ route('students.create') }}" class="btn btn-success btn-lg shadow"><i class="fa-solid fa-plus"></i> Tambah Data</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col" class="text-center">Foto</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr class="text-center align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->nama_mahasiswa }}</td>
                                            <td>{{ $student->jenis_kelamin }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d-m-Y') }}</td>
                                            <td>{!! $student->alamat !!}</td>
                                            <td class="text-center">
                                                @if ($student->foto)
                                                    <img src="{{ asset('/storage/'.$student->foto) }}" class="rounded img-thumbnail shadow-sm" style="width: 100px; height: auto;">
                                                @else
                                                    Tidak ada foto
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <form id="delete-form-{{ $student->id }}" onsubmit="return confirmDelete({{ $student->id }});" action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm shadow-sm text-white"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center alert alert-warning">
                                                Data mahasiswa belum tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Toastr notification
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'Berhasil!');
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'Gagal!');
        @endif

        function confirmDelete(studentId) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + studentId).submit();
                }
            })
        }
    </script>
</body>
</html>
