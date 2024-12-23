<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Keluhan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
            font-weight: bold;
        }
        .preview-image {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: none;
        }
        button:disabled {
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h1 class="text-center mb-4">
                        <i class="fa-solid fa-envelope-circle-check me-2"></i>Form Keluhan
                    </h1>
                    <form method="POST" action="{{ route('report.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Provinsi -->
                        <div class="mb-3">
                            <label for="province" class="form-label">Provinsi*</label>
                            <select id="province" name="province" class="form-select">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>

                        <!-- Kabupaten -->
                        <div class="mb-3">
                            <label for="regency" class="form-label">Kabupaten/Kota*</label>
                            <select id="regency" name="regency" class="form-select" disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                        </div>

                        <!-- Kecamatan -->
                        <div class="mb-3">
                            <label for="subdistrict" class="form-label">Kecamatan*</label>
                            <select id="subdistrict" name="subdistrict" class="form-select" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>

                        <!-- Desa -->
                        <div class="mb-3">
                            <label for="village" class="form-label">Desa/Kelurahan*</label>
                            <select id="village" name="village" class="form-select" disabled>
                                <option value="">Pilih Desa/Kelurahan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe*</label>
                            <select id="type" name="type" class="form-select" >
                                <option value="" disabled hidden selected>Pilih Tipe</option>
                                <option value="KEJAHATAN">Kejahatan</option>
                                <option value="PEMBANGUNAN">Pembangunan</option>
                                <option value="SOSIAL">Sosial</option>
                            </select>
                        </div>

                        <!-- Detail Keluhan -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Detail Keluhan*</label>
                            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Tuliskan keluhan Anda"></textarea>
                        </div>

                        <!-- Pilih Gambar -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Gambar Pendukung</label>
                            <input type="file" id="gambar" name="image" class="form-control" accept="image/*">
                            <img id="previewImage" class="preview-image" src="#" alt="Pratinjau Gambar">
                        </div>

                        <!-- Pernyataan Konfirmasi -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="statement" name="statement" required>
                            <label class="form-check-label" for="statement">
                                Laporan yang disampaikan sesuai dengan kebenaran.
                            </label>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-center">
                            <button type="submit" id="submitBtn" class="btn btn-primary w-100" >
                                <i class="fa-solid fa-paper-plane me-2"></i>Kirim Keluhan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function () {
        // Ambil data provinsi saat halaman pertama kali dimuat
        $.ajax({
            url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
            type: "GET",
            success: function (data) {
                // Isi dropdown provinsi
                $("#province").append('<option value="">Pilih</option>'); // Tambahkan option pertama
                data.forEach(function (provinsi) {
                    $("#province").append(
                        '<option value="' +
                            provinsi.name +
                            '" data-id="' +
                            provinsi.id +
                            '">' +
                            provinsi.name +
                            "</option>"
                    );
                });
            },
        });

        // Ketika provinsi dipilih, ambil data kota berdasarkan provinsi yang dipilih
        $("#province").change(function () {
            var provinsiId = $(this).find(":selected").data("id"); // Ambil id dari data-id
            if (provinsiId) {
                // Enable regency select after province is selected
                $("#regency").prop("disabled", false);
                $.ajax({
                    url:
                        "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" +
                        provinsiId +
                        ".json",
                    type: "GET",
                    success: function (data) {
                        // Kosongkan dropdown kota
                        $("#regency")
                            .empty()
                            .append('<option value="">Pilih</option>');
                        // Isi dropdown kota
                        data.forEach(function (kota) {
                            $("#regency").append(
                                '<option value="' +
                                    kota.name +
                                    '" data-id="' +
                                    kota.id +
                                    '">' +
                                    kota.name +
                                    "</option>"
                            );
                        });
                    },
                });
            } else {
                $("#regency").empty().append('<option value="">Pilih</option>');
                $("#regency").prop("disabled", true);
                $("#subdistrict").empty().append('<option value="">Pilih</option>');
                $("#subdistrict").prop("disabled", true);
                $("#village").empty().append('<option value="">Pilih</option>');
                $("#village").prop("disabled", true);
            }
        });

        // Ketika kota dipilih, ambil data kecamatan berdasarkan kota yang dipilih
        $("#regency").change(function () {
            var kotaId = $(this).find(":selected").data("id"); // Ambil id dari data-id
            if (kotaId) {
                // Enable subdistrict select after regency is selected
                $("#subdistrict").prop("disabled", false);
                $.ajax({
                    url:
                        "https://www.emsifa.com/api-wilayah-indonesia/api/districts/" +
                        kotaId +
                        ".json",
                    type: "GET",
                    success: function (data) {
                        // Kosongkan dropdown kecamatan
                        $("#subdistrict")
                            .empty()
                            .append('<option value="">Pilih</option>');
                        // Isi dropdown kecamatan
                        data.forEach(function (kecamatan) {
                            $("#subdistrict").append(
                                '<option value="' +
                                    kecamatan.name +
                                    '" data-id="' +
                                    kecamatan.id +
                                    '">' +
                                    kecamatan.name +
                                    "</option>"
                            );
                        });
                    },
                });
            } else {
                $("#subdistrict").empty().append('<option value="">Pilih</option>');
                $("#subdistrict").prop("disabled", true);
                $("#village").empty().append('<option value="">Pilih</option>');
                $("#village").prop("disabled", true);
            }
        });

        // Ketika kecamatan dipilih, ambil data kelurahan berdasarkan kecamatan yang dipilih
        $("#subdistrict").change(function () {
            var kecamatanId = $(this).find(":selected").data("id"); // Ambil id dari data-id
            if (kecamatanId) {
                // Enable village select after subdistrict is selected
                $("#village").prop("disabled", false);
                $.ajax({
                    url:
                        "https://www.emsifa.com/api-wilayah-indonesia/api/villages/" +
                        kecamatanId +
                        ".json",
                    type: "GET",
                    success: function (data) {
                        // Kosongkan dropdown kelurahan
                        $("#village")
                            .empty()
                            .append('<option value="">Pilih</option>');
                        // Isi dropdown kelurahan
                        data.forEach(function (kelurahan) {
                            $("#village").append(
                                '<option value="' +
                                    kelurahan.name +
                                    '" data-id="' +
                                    kelurahan.id +
                                    '">' +
                                    kelurahan.name +
                                    "</option>"
                            );
                        });
                    },
                });
            } else {
                $("#village").empty().append('<option value="">Pilih</option>');
                $("#village").prop("disabled", true);
            }
        });
    });
    </script>