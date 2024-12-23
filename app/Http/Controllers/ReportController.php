<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Response;
use App\Models\ResponseProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua tanggal yang ada pada laporan
        $dates = Report::selectRaw('DATE(created_at) as date')->distinct()->get()->pluck('date');
        // $reports = Report::all();
        
        // Filter laporan berdasarkan tanggal yang dipilih
        if ($request->has('date') && $request->date != '') {
            $reports = Report::whereDate('created_at', $request->date)->get();
        } else {
            $reports = Report::where('province', 'LIKE', '%'.$request->search.'%')->simplePaginate(100)->appends($request->all()); // Ambil semua laporan jika tidak ada filter tanggal
        }
    
        return view('report.index', compact('reports', 'dates'));
    }    


    public function create()
    {
        return view('report.create');
    }

    public function article()
    {
        $reports = Report::all();
        return view ('report.article', compact('reports'));
    }

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'province' => 'required',
        'regency' => 'required',
        'subdistrict' => 'required',
        'village' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'type' => 'required|string', 
    ]);

    // Proses upload gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
    }

    // Simpan data ke database dengan user_id
    Report::create([
        'user_id' => Auth::id(),
        'province' => json_encode($request->province), // Encode menjadi JSON jika perlu
        'regency' => json_encode($request->regency),
        'subdistrict' => json_encode($request->subdistrict),
        'village' => json_encode($request->village),
        'description' => $request->description,
        'image' => $imagePath,
        'type' => $request->type, // Pastikan data type adalah string yang valid
    ]);

    // Redirect dengan alert sukses
    return redirect()->route('report.dashboard')->with('success', 'Keluhan berhasil dikirim!');
}


    public function edit(Report $report)
    {
        return view('report.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'description' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
        ]);

        $report->update($validated);

        return redirect()->route('reports.index');
    }

    public function destroy($id)
{
    try {
        $report = Report::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($report->image && Storage::exists('public/' . $report->image)) {
            Storage::delete('public/' . $report->image);
        }

        // Hapus pengaduan
        $report->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    } catch (ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Pengaduan tidak ditemukan.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus pengaduan.');
    }
}

    // public function article(Request $request)
    // {
    //     $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    //     $provinces = $response->json();
    
    //     $reports = Report::when($request->province, function ($query) use ($request) {
    //         return $query->where('province', $request->province);
    //     })->get();
    
    //     foreach ($reports as $report) {
    //         // Cek apakah laporan sudah dilihat dalam sesi
    //         if (!session()->has("viewed_reports_{$report->id}")) {
    //             $report->increment('viewers');
    //             session()->put("viewed_reports_{$report->id}", true); // Tandai laporan sudah dilihat
    //         }
    //     }
    
    //     $provinces_map = [];
    //     foreach ($provinces as $province) {
    //         $provinces_map[$province['id']] = $province['name'];
    //     }
    
    //     $reports->transform(function ($report) use ($provinces_map) {
    //         $report->province_name = $provinces_map[$report->province] ?? 'Tidak Diketahui';
    //         return $report;
    //     });
    
    //     return view('reports.article', [
    //         'reports' => $reports,
    //         'provinces' => $provinces,
    //     ]);
    // }

    public function vote(Request $request, $id)
{
    $report = Report::findOrFail($id);

    // Pastikan data voting dalam bentuk array
    $voting = is_array($report->voting) ? $report->voting : json_decode($report->voting, true) ?? [];

    $userId = auth()->id();
    $message = '';

    if (in_array($userId, $voting)) {
        // Jika user ID ditemukan, batalkan vote
        $voting = array_diff($voting, [$userId]);
        $message = 'Berhasil membatalkan vote!';
    } else {
        // Jika user ID tidak ditemukan, tambahkan vote
        $voting[] = $userId;
        $message = 'Berhasil memberikan vote!';
    }

    // Simpan data voting kembali ke database
    $report->voting = $voting;
    $report->save();

    // Kembalikan dengan pesan berdasarkan aksi
    return redirect()->back()->with('success', $message);
}



    public function show($id)
    {
        $report = Report::with('comments.user')->findOrFail($id);  // Memuat komentar dengan relasi ke user
        $report->viewers += 1;
        $report->save();
        $comments = $report->comments;  // Mendapatkan komentar terkait dengan pengaduan
        return view('report.article', compact('report', 'comments'));

    }    
    public function dashboard()
    {
        $reports = Report::with('response.response_progress')->where('user_id', Auth::id())->latest()->get();
        // dd($reports);
        $responses = Response::all();
        $response_progress = ResponseProgress::all();
        return view('report.monitoring', compact('reports', 'responses', 'response_progress'));
    }



}