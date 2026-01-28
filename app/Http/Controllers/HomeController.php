<?php

namespace App\Http\Controllers;

use App\Models\Bread;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //show list of breads on home page
    public function index()
    {
        $breads = Bread::where('is_available', true)->orderBy('created_at', 'desc')->paginate(12);

        return view('home', compact('breads'));
    }

    //show chi tiết bánh
    public function show($id)
    {
        $bread = Bread::findOrFail($id);
        return view('bread-detail', compact('bread'));
    }
}
