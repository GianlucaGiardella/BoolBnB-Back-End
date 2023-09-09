<?php

namespace App\Http\Controllers\Admin;

use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{

    public function index()
    {
        return view('admin.views.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(View $views)
    {
        //
    }

    public function edit(View $views)
    {
        //
    }

    public function update(Request $request, View $views)
    {
        //
    }

    public function destroy(View $views)
    {
        //
    }
}
