<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function beranda() {
        return view('pages.beranda');
    }

    public function artikel() {
        return view('pages.artikel');
    }

    public function tanyaJawab() {
        return view('pages.tanya-jawab');
    }

    public function unduhan() {
        return view('pages.unduhan');
    }

    public function pengingat() {
        return view('pages.pengingat');
    }
}
