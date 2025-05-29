<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\News;
use App\Models\Faq;

class PageController extends Controller
{
    public function beranda()
    {
        // Ambil semua artikel dari database
        $articles = Article::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->get();

        // Kirim data ke view
        return view('pages.beranda', compact('articles', 'testimonials'));
    }

    public function artikel()
    {
        // Ambil artikel terbaru (artikel yang paling baru ditambahkan)
        $latestArticle = Article::latest()->first();

        // Ambil artikel lainnya (selain artikel terbaru)
        $otherArticles = Article::latest()->skip(1)->take(PHP_INT_MAX)->get();

        // Ambil 2 berita terbaru
        $news = News::latest()->take(2)->get();

        // Kirim data ke view
        return view('pages.artikel', compact('latestArticle', 'otherArticles', 'news'));
    }

    public function artikelDetail($slug)
    {
        // Cari artikel berdasarkan slug
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // Ambil artikel terkait berdasarkan kategori yang sama
        $relatedArticles = Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();
        
        // Ambil artikel sebelumnya dan selanjutnya untuk navigasi
        $previousArticle = Article::where('id', '<', $article->id)->orderBy('id', 'desc')->first();
        $nextArticle = Article::where('id', '>', $article->id)->orderBy('id', 'asc')->first();
    
        return view('pages.artikel-detail', compact('article', 'relatedArticles', 'previousArticle', 'nextArticle'));
    }

    public function tanyaJawab() {
        $faqs = Faq::all();

        return view('pages.tanya-jawab', compact('faqs'));
    }

    public function unduhanModul()
    {
        $downloads = Download::where('category', 'modul')->get();
        return view('pages.unduhan-modul', compact('downloads'));
    }
    
    public function unduhanFlayer()
    {
        $downloads = Download::where('category', 'flayer')->get();
        return view('pages.unduhan-flayer', compact('downloads'));
    }

    public function pengingat() {
        return view('pages.pengingat');
    }

    public function berita()
    {
        // Ambil semua berita, urutkan berdasarkan yang terbaru
        $allNews = News::latest()->paginate(10); // Pagination untuk 10 berita per halaman
    
        // Kirim data ke view
        return view('pages.berita', compact('allNews'));
    }

    public function petunjuk()
    {
        return view('pages.petunjuk');
    }
}
