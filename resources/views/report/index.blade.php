    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Pengaduan Masyarakat')</title>
        <!-- Bootstrap & FontAwesome -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GNrwoFltNhjsXJS17j7WlbkvZwjBi6FPbZlWtb8FZjrBsGGbW3dAR3eM0CJvf6Qk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
            integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <!-- Bootstrap CSS (CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            body {
                background-color: #f7f7f7;
                font-family: 'Arial', sans-serif;
                color: #333;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .alert-success {
                background-color: #d4edda;
                border-color: #c3e6cb;
                color: #155724;
                border-radius: 10px;
                margin-bottom: 30px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .search-bar {
                display: flex;
                justify-content: center;
                margin-bottom: 40px;
                gap: 15px;
            }

            .search-bar select,
            .search-bar button {
                font-size: 1rem;
                padding: 12px;
            }

            .article-card {
                display: flex;
                align-items: center;
                background-color: #ffffff;
                border: 1px solid #e3e6f0;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                padding: 15px;
                transition: transform 0.3s ease;
            }

            .article-card:hover {
                transform: translateY(-5px);
            }

            .article-card img {
                width: 150px;
                height: auto;
                border-radius: 10px;
                object-fit: cover;
            }

            .article-content {
                margin-left: 20px;
                flex: 1;
            }

            .article-content a {
                font-size: 1.25rem;
                font-weight: bold;
                color: #007bff;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .article-content a:hover {
                text-decoration: underline;
                color: #0056b3;
            }

            .vote-button {
                display: flex;
                align-items: center;
                gap: 5px;
                color: #e74c3c;
                text-decoration: none;
            }

            .vote-button i {
                font-size: 1.2rem;
            }

            .info-box {
                background-color: #fff;
                border-left: 5px solid #ffc107;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-top: 40px;
            }

            .info-box h6 {
                font-weight: bold;
                margin-bottom: 15px;
            }

            .info-box ol {
                margin-left: 20px;
            }

            .side-icons {
                position: fixed;
                top: 50%;
                right: 20px;
                transform: translateY(-50%);
                display: flex;
                flex-direction: column;
                gap: 15px;
                z-index: 1000;
            }

            .side-icons a {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 50px;
                height: 50px;
                background-color: #555;
                color: white;
                border-radius: 50%;
                text-decoration: none;
                font-size: 1.5rem;
                transition: background-color 0.3s;
            }

            .side-icons a:hover {
                background-color: #777;
            }

            .side-icons a i {
                transition: transform 0.3s ease;
            }

            .side-icons a:hover i {
                transform: scale(1.2);
            }
        </style>
    </head>

    <body>
        <div class="container">
            <!-- Success Notification -->
            @if(session('success'))
            <div class="alert alert-success d-flex align-items-center justify-content-between shadow-sm mx-auto" 
                style="max-width: 1150px; border-radius: 10px; padding: 15px;">
                <span style="font-size: 1rem; color: #155724;">
                    {{ session('success') }}
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Search Form -->
            <form id="search" role="search" method="GET" action="{{ route('report.pengaduan') }}" class="search-bar">
                <select name="search" id="province" class="form-select w-50">
                    <option value="" selected disabled>Pilih Provinsi</option>
                </select>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <h3 class="text-center mb-4">Artikel Terkait</h3>
            @if (auth()->check())
        <p>Halo, {{ auth()->user()->email }}! Anda berhasil login.</p>
    @else
        <p>Anda belum login.</p>
    @endif

            @if($reports->isEmpty())
            <p class="text-center">Artikel pengaduan tidak ada</p>
            @else
            @foreach ($reports as $report)
            @php
            $currentVoting = is_string($report->voting) ? json_decode($report->voting, true) : (array) $report->voting;
            @endphp

            <div class="article-card" id="report-{{ $report->id }}">
                <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Pengaduan">
                <div class="article-content">
                    <a href="{{ route('report.show', $report->id) }}">{{ $report->description }}</a>
                    <p class="text-muted mt-2">
                        <i class="fa-regular fa-eye">{{ $report->viewers }}</i>
                        <i class="fa-regular fa-heart"></i>
                        <span class="vote-count">{{ count($currentVoting) }}</span> &nbsp;
                        {{ $report->user->email }} &bullet; {{ $report->created_at->diffForHumans() }}
                    </p>
                    <form class="w-auto p-0" action="{{ route('report.vote', $report->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn w-auto">
                            <i class="fa-solid fa-heart {{ in_array(auth()->id(), $currentVoting) ? 'text-danger' : '' }}"></i>
                            <span>{{ count($currentVoting) }}</span>
                            Vote
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            @endif

            <!-- Information Box -->
            <div class="info-box mt-4">
                <h6><i class="fa fa-info-circle text-warning"></i> Informasi Pembuatan Pengaduan</h6>
                <ol>
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun.</li>
                    <li>Data pada pengaduan harus <strong>BENAR dan DAPAT DIPERTANGGUNGJAWABKAN</strong>.</li>
                    <li>Seluruh bagian data perlu diisi.</li>
                    <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
                    <li>Periksa tanggapan Kami pada <strong>Dashboard</strong> setelah Login.</li>
                    <li>Form pengaduan dapat diakses di sini: <a href="{{ route('report.create') }}">Form Pengaduan</a></li>
                </ol>
            </div>
        </div>

        <div class="side-icons">
            <a href="{{route('report.pengaduan')}}"><i class="bi bi-house"></i></a>
            <a href="{{route('report.dashboard')}}"><i class="bi bi-exclamation-circle"></i></a>
            <a href="{{route('report.create')}}"><i class="bi bi-pencil"></i></a>
        </div>

        <script>
            $(document).ready(function () {
                // Memuat daftar provinsi
                $.ajax({
                    method: "GET",
                    url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                    dataType: "json",
                    success: function (response) {
                        let dropdown = $("#province");
                        response.forEach(function (province) {
                            dropdown.append(`<option value="${province.id}">${province.name}</option>`);
                        });
                    },
                    error: function () {
                        alert("Gagal memuat data provinsi. Silakan coba lagi.");
                    }
                });

                // Menutup alert otomatis setelah 5 detik
                setTimeout(function () {
                    let alert = document.querySelector('.alert');
                    if (alert) {
                        let bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });
        </script>
    </body>

    </html>
