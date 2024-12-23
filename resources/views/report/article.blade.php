<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <!-- Blog entries (Main Content)-->
            <div class="col-lg-8 mb-4">
                <div class="card mb-4 shadow-sm">
                    @if ($report->image)
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $report->image) }}" class="w-100 h-100 object-fit-cover rounded-start" alt="Report Image" style="max-height: 600px;">
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <p class="small text-muted mb-0">Tanggal Pengaduan: {{ $report->created_at->format('d-m-Y') }}</p>
                                <p class="small text-muted mb-0">Email Pengguna: {{ $report->user->email }}</p>
                                <p class="small text-muted mb-0">Tipe Pengaduan: {{ $report->type }}</p>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-outline-primary me-2"><i class="bi bi-eye"></i> 123 Views</button>
                                <button class="btn btn-outline-danger"><i class="bi bi-heart"></i> <span>10 Votes</span></button>
                            </div>
                        </div>
                        <h5 class="card-title mb-3">{{ $report->description }}</h5>
                        <p>{{ $report->details }}</p>
                    </div>
                </div>

                <!-- Komentar Section -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">Kirim Komentar</h4>
                        <div class="d-flex">
                            <img class="rounded-circle shadow-1-strong me-3" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="avatar" width="60" height="60" />
                            <div class="w-100">
                                <h6 class="fw-bold mb-1">User Email</h6>
                                <form action="{{ route('report.comment.store', $report->id) }}" method="POST">
                                    @csrf
                                    <textarea name="comment" rows="5" required class="form-control mb-0 w-100" placeholder="Tulis komentar Anda..."></textarea>
                                    <button class="btn btn-primary mt-2" type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                </div>

                <!-- Displaying Comments Section -->
                <div class="w-full py-5">
                    <div class="row d-flex justify-content-center w-full">
                        <div class="col-md-12 w-full">
                            <div class="card text-body shadow-sm">
                                <div class="card-body p-4">
                                    <h4 class="mb-4">Komentar</h4>
                                    @foreach($report->comments as $comment)
                                        <div class="d-flex flex-start mb-3">
                                            <img class="rounded-circle shadow-1-strong me-3" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="avatar" width="60" height="60" />
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $comment->user->email }}</h6>
                                                <p class="mb-0">{{ $comment->comment_text }}</p>
                                            </div>
                                        </div>
                                        <hr class="my-3" />
                                    @endforeach

                                    @if ($report->comments->isEmpty())
                                        <p>Tidak ada komentar.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Side widgets (Informasi Pembuatan Pengaduan)-->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white fw-bold">
                        <i class="bi bi-info-circle-fill"></i> Informasi Pembuatan Pengaduan
                    </div>
                    <div class="card-body">
                        <ol class="list-unstyled">
                            <li><i class="bi bi-check-circle-fill text-success"></i> Pengaduan hanya dapat dibuat oleh pengguna yang sudah terdaftar.</li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Semua data yang diinput harus <b>BENAR dan DAPAT DIPERTANGGUNGJAWABKAN.</b></li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Semua bagian data perlu diisi.</li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Pengaduan akan ditanggapi dalam waktu 2x24 jam.</li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Periksa tanggapan di <b>Dashboard</b> setelah login.</li>
                            <li><i class="bi bi-link-45deg"></i> Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="#">Ikuti Tautan</a></li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
