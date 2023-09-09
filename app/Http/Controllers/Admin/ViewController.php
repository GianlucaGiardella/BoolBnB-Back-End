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
}