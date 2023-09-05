<?php

namespace App\Http\Controllers;
use App\Models\Sponsor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorController extends Controller
{
    public function index()
    {
        return view('admin.sponsor.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sponsor $sponsor)
    {
        //
    }

    public function edit(Sponsor $sponsor)
    {
        //
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    public function destroy(Sponsor $sponsor)
    {
        //
    }
}