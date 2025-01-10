<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Open Sans', sans-serif;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
        }
        .btn {
            border-radius: 10px;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 30px;
        }
        .form-group label {
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        footer {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
        .alert {
            font-size: 0.875rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        /* Quill container style */
        .ql-container {
            border-radius: 10px;
            min-height: 200px;
            font-family: 'Open Sans', sans-serif;
        }
        .ql-toolbar {
            border-radius: 10px 10px 0 0;
        }
        .ql-editor {
            min-height: 200px;
        }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="header text-center">
                        <h3>Edit Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama Field -->
                            <div class="form-group">
                                <label for="nama_mahasiswa">Nama</label>
                                <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" id="nama_mahasiswa" value="{{ old('nama_mahasiswa', $student->nama_mahasiswa) }}" placeholder="Masukkan Nama Mahasiswa">
                                @error('nama_mahasiswa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir Field -->
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}">
                                @error('tanggal_lahir')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Alamat Field -->
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ old('alamat', $student->alamat) }}" placeholder="Masukkan Alamat">
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Foto Field -->
                            <div class="form-group">
                                <label for="foto">Upload Foto</label>
                                <input type="file" class="form-control pb-5 pt-3 @error('foto') is-invalid @enderror" name="foto" id="foto">
                                @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Gender Field -->
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control pt-1 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-warning btn-lg">Simpan</button>
                                <a href="{{ route('students.index') }}" class="btn btn-outline-dark btn-lg">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        // Initialize Quill editor (if needed for other fields like Deskripsi)
        var quill = new Quill('#content', {
            theme: 'snow',
            placeholder: 'Masukkan Deskripsi Mahasiswa...',
            modules: {
                toolbar: [
                    [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'],
                    [{ 'align': [] }],
                    ['clean']
                ]
            }
        });

        document.querySelector('form').onsubmit = function() {
            document.querySelector('#hiddenContent').value = quill.root.innerHTML;
        };

        // Set initial content (useful when editing existing content)
        quill.root.innerHTML = `{{ old('content', $student->content) }}`;
    </script>
</body>
</html>
