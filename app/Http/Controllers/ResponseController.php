<?php

namespace App\Http\Controllers;

use App\Models\Report; // Import model Report
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{

    public function dashboard()
    {
        $reports = Report::all(); // Ambil semua report
        $responses = Response::with('response_progress')->get(); // Ambil semua response

        return view('report.monitoring', compact('reports', 'responses'));
    }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
