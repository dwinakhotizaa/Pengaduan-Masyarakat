<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Halaman Data Pengguna</title>
</head>
<body>
    @if (Session::get('success')) 
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container">
        <h1 class="text-center">Halaman Data Pengguna</h1>

        <a href="{{ route('akun.tambah') }}" class="btn btn-primary mb-3">Tambah Akun</a>
        <a href="#" class="btn btn-success mb-3 ms-3">Export Excel</a>

        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">Data Pengguna Kosong</td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Hapus -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun ini <span id="nama-akun"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="modal_edit_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kelola Data Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
