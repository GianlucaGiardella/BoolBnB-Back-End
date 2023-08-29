<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $view = View::all();
        return response()->json($view);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(View $view)
    {
        //
    }

    public function edit(View $view)
    {
        //
    }

    public function update(Request $request, View $view)
    {
        //
    }

    public function destroy(View $view)
    {
        //
    }
}