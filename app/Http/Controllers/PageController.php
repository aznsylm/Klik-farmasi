<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\News;

class PageController extends Controller
{
    public function beranda()
    {
        // Ambil semua artikel dari database
        $articles = Article::latest()->get();

        // Kirim data ke view
        return view('pages.beranda', compact('articles'));
    }

    public function artikel()
    {
        // Ambil artikel terbaru (artikel yang paling baru ditambahkan)
        $latestArticle = Article::latest()->first();

        // Ambil artikel lainnya (selain artikel terbaru)
        $otherArticles = Article::latest()->skip(1)->take(PHP_INT_MAX)->get();

        $news = News::latest()->take(5)->get();

        // Kirim data ke view
        return view('pages.artikel', compact('latestArticle', 'otherArticles', 'news'));
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
