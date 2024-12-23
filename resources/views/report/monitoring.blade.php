@extends('report.main')

@section('report')

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.5s ease-out forwards;
    }
</style>
<nav class="navbar bg-body-tertiary">
            <div class="container-fluid ms-5">
                <a class="navbar-brand" href="#">
                    Pengaduan
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-outline-secondary {{ Route::is('logout') ? 'active' : ''}}" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

<main class="container mx-auto py-8 px-4 max-w-4xl">
    <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-gray-800 animate-fadeIn">Monitoring Pengaduan</h1>
    <div class="space-y-6">
        @forelse ($reports as $index => $report)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:shadow-xl animate-fadeIn"
                style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="bg-green-600 text-white px-6 py-4 flex justify-between items-center cursor-pointer toggle-content"
                    data-target="content-{{ $index }}">
                    <h2 class="text-lg font-bold">
                        Pengaduan
                        {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('j F Y') }}
                    </h2>
                    <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
                </div>

                <div class="report-content hidden opacity-0 transition-all duration-300 ease-in-out"
                    id="content-{{ $index }}">
                    <div class="px-6 py-4">
                        <ul class="flex justify-between items-center mb-4 border-b border-gray-200">
                            <li class="tab-button px-4 py-2 cursor-pointer text-green-600 hover:text-green-800 font-medium transition duration-200"
                                data-tab="data-{{ $index }}">Data</li>
                            <li class="tab-button px-4 py-2 cursor-pointer text-green-600 hover:text-green-800 font-medium transition duration-200"
                                data-tab="gambar-{{ $index }}">Gambar</li>
                            <li class="tab-button px-4 py-2 cursor-pointer text-green-600 hover:text-green-800 font-medium transition duration-200"
                                data-tab="status-{{ $index }}">Status</li>
                        </ul>

                        <!-- Data Tab -->
                        <div id="data-{{ $index }}" class="tab-content mb-4 hidden">
                            <h3 class="text-green-800 font-semibold text-lg mb-2">Data Pengaduan</h3>
                            <ul class="text-gray-600 space-y-2">
                                <li><span class="font-medium">Tipe:</span> {{ $report->type }}</li>
                                <li><span class="font-medium">Lokasi:</span> {{ $report->village }},
                                        {{ $report->subdistrict }}, {{ $report->regency }}, {{ $report->province }}
                                    </li> 
                                </li>
                                <li class="break-words"><span class="font-medium">Deskripsi:</span>
                                    {{ $report->description }}</li>
                            </ul>
                        </div>

                        <!-- Gambar Tab -->
                        <div id="gambar-{{ $index }}" class="tab-content mb-4 hidden">
                            <h3 class="text-green-800 font-semibold text-lg mb-2">Gambar Pengaduan</h3>
                            <div class="flex justify-center">
                                <img src="{{ asset('storage/' . $report->image) }}"
                                    alt="Gambar Pengaduan"
                                    class="rounded-md shadow-md w-full max-w-md h-60 object-cover transition duration-300 transform hover:scale-105">
                            </div>
                        </div>

                        <!-- Status Tab -->
                        <div id="status-{{ $index }}" class="tab-content mb-4 hidden">
                            <h3 class="text-green-800 font-semibold text-lg mb-2">Status Pengaduan</h3>
                            @if ($report->response == null)
                                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                                    <p class="font-bold">Belum Direspon</p>
                                    <p>Pengaduan belum direspon oleh petugas.</p>
                                </div>
                                <form action="{{ route('report.destroy', $report->id)}}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none transition duration-200">
                                        <i class="fas fa-trash-alt mr-2"></i> HAPUS
                                    </button>
                                </form>
                            @else
                                <div class="space-y-4">
                                    <p class="font-semibold text-gray-700">Response Status:
                                        <span
                                            class="text-lg font-medium @if ($report->response->response_status == 'ON_PROCESS') text-yellow-500
                                            @elseif($report->response->response_status == 'DONE') text-green-600
                                            @else text-red-600 @endif">
                                            {{ $report->response->response_status }}
                                        </span>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-lg p-8 text-center animate-fadeIn">
                <i class="fas fa-exclamation-circle text-6xl text-green-500 mb-4"></i>
                <p class="text-xl font-semibold text-gray-800 mb-4">
                    Belum ada pengaduan yang dibuat. Yuk, buat pengaduan baru untuk membantu memperbaiki lingkungan
                    sekitar!
                </p>
                <a href="{{ route('report.guest_create_report') }}"
                    class="inline-block bg-green-500 text-white px-6 py-3 rounded-md shadow hover:bg-green-600 transition duration-300 font-medium">
                    Buat Pengaduan Baru
                </a>
            </div>
        @endforelse
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll(".toggle-content").forEach((header) => {
            header.addEventListener("click", () => {
                const targetId = header.getAttribute("data-target");
                const targetContent = document.getElementById(targetId);
                const toggleIcon = header.querySelector(".toggle-icon");

                if (targetContent.classList.contains("hidden")) {
                    targetContent.classList.remove("hidden", "opacity-0");
                    targetContent.classList.add("opacity-100");
                    toggleIcon.classList.add("rotate-180");
                } else {
                    targetContent.classList.remove("opacity-100");
                    targetContent.classList.add("opacity-0");
                    setTimeout(() => {
                        targetContent.classList.add("hidden");
                    }, 300);
                    toggleIcon.classList.remove("rotate-180");
                }
            });
        });

        document.querySelectorAll(".bg-white").forEach((container) => {
            const tabs = container.querySelectorAll(".tab-button");
            const contents = container.querySelectorAll(".tab-content");

            contents[0]?.classList.remove("hidden");
            tabs[0]?.classList.add("text-green-800", "border-b-2", "border-green-500");

            tabs.forEach((tab) => {
                tab.addEventListener("click", () => {
                    const tabName = tab.getAttribute("data-tab");

                    tabs.forEach(t => t.classList.remove("text-green-800", "border-b-2", "border-green-500"));
                    tab.classList.add("text-green-800", "border-b-2", "border-green-500");

                    contents.forEach((content) => {
                        content.classList.add("hidden");
                    });

                    container.querySelector(`#${tabName}`).classList.remove("hidden");
                });
            });
        });
    });
</script>

@endsection
