<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-warning {
            color: white;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Form Tambah Data Mahasiswa
                    </div>
                    <div class="card-body">
                        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Input Nama Mahasiswa -->
                            <div class="form-group">
                                <label>Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" placeholder="Masukkan Nama Mahasiswa...">
                                @error('nama_mahasiswa')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Jenis Kelamin -->
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin...</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Tanggal Lahir -->
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Input Alamat dengan Quill Editor -->
                            <div class="form-group">
                                <label>Alamat</label>
                                <div id="editor-container"></div>
                                <input type="hidden" name="alamat" id="alamat">
                                @error('alamat')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input File Foto -->
                            <div class="form-group">
                                <label>Upload Foto</label>
                                <input type="file" class="form-control pb-5 pt-3 @error('foto') is-invalid @enderror" name="foto">
                                @error('foto')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>  

                            <!-- Tombol Submit dan Kembali-->
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-success btn-lg px-4">Simpan</button>
                                <a href="{{ route('students.index') }}" class="btn btn-outline-dark btn-lg">Kembali</a>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JS Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Quill.js Library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Masukkan Alamat Mahasiswa...',
        });

        // Kirim data alamat ke input hidden saat form di-submit
        document.querySelector('form').onsubmit = function() {
            document.querySelector('input[name=alamat]').value = quill.root.innerHTML;
        };
    </script>
</body>
</html>
