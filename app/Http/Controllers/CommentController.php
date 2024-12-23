<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $reportId)
    {
       // Validasi input
       $request->validate([
        'comment' => 'required|string|max:500',
    ]);

    // Cari laporan terkait
    $report = Report::findOrFail($reportId);

    // Simpan komentar
    $report->comments()->create([
        'report_id' => $report->id,
        'user_id' => auth()->id(), // Pastikan user login
        'comment_text' => $request->comment,
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Komentar berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
