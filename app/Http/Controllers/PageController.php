<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleRead;
use App\Models\DownloadRead;
use App\Models\Testimonial;
use App\Models\News;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;

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
        // Redirect to kehamilan articles by default
        return redirect()->route('artikel.kehamilan');
    }
    
    public function artikelKehamilan()
    {
        // Ambil artikel terbaru untuk hipertensi kehamilan
        $latestArticle = Article::where('article_type', 'kehamilan')->latest()->first();

        // Ambil semua artikel lainnya untuk hipertensi kehamilan
        $otherArticles = Article::where('article_type', 'kehamilan')
                        ->latest()
                        ->when($latestArticle, function($query) use ($latestArticle) {
                            return $query->where('id', '!=', $latestArticle->id);
                        })
                        ->get(); // Ambil semua artikel

        // Kirim data ke view
        return view('pages.artikel-kehamilan', compact('latestArticle', 'otherArticles'));
    }

    public function artikelNonKehamilan()
    {
        // Ambil artikel terbaru untuk hipertensi non-kehamilan
        $latestArticle = Article::where('article_type', 'non-kehamilan')->latest()->first();

        // Ambil artikel lainnya untuk hipertensi non-kehamilan dengan pagination
        $otherArticles = Article::where('article_type', 'non-kehamilan')
            ->latest()
            ->when($latestArticle, function($query) use ($latestArticle) {
                return $query->where('id', '!=', $latestArticle->id);
            })
            ->get(); 

        return view('pages.artikel-non-kehamilan', compact('latestArticle', 'otherArticles'));
    }

    public function artikelDetail($slug)
    {
        // Tentukan article_type berdasarkan URL
        $currentRoute = request()->route()->getName();
        $articleType = $currentRoute === 'artikel.detail.kehamilan' ? 'kehamilan' : 'non-kehamilan';

        // Cari artikel berdasarkan slug dan article_type
        $article = Article::where('slug', $slug)
                         ->where('article_type', $articleType)
                         ->firstOrFail();

        // Track article read untuk pasien yang login
        if (Auth::check() && Auth::user()->role === 'pasien') {
            $existingRead = ArticleRead::where('article_id', $article->id)
                                     ->where('user_id', Auth::id())
                                     ->first();
            
            if ($existingRead) {
                // Increment access count for existing reader
                $existingRead->increment('access_count');
            } else {
                // Create new record for first-time reader
                ArticleRead::create([
                    'article_id' => $article->id,
                    'user_id' => Auth::id(),
                    'access_count' => 1
                ]);
            }
        }

        // Ambil artikel terkait berdasarkan article_type yang sama
        $relatedArticles = Article::where('article_type', $article->article_type)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(10)
            ->get();

        // Ambil artikel sebelumnya dan selanjutnya untuk navigasi (dalam kategori yang sama)
        $previousArticle = Article::where('article_type', $article->article_type)
            ->where('id', '<', $article->id)
            ->orderBy('id', 'desc')
            ->first();
        $nextArticle = Article::where('article_type', $article->article_type)
            ->where('id', '>', $article->id)
            ->orderBy('id', 'asc')
            ->first();

        return view('pages.artikel-detail', compact('article', 'relatedArticles', 'previousArticle', 'nextArticle'));
    }

    public function tanyaJawabKehamilan() {
        $faqs = Faq::where('category', 'Hipertensi Kehamilan')->orderBy('updated_at', 'desc')->get();
        return view('pages.tanya-jawab-kehamilan', compact('faqs'));
    }

    public function tanyaJawabNonKehamilan() {
        $faqs = Faq::where('category', 'Hipertensi Non-Kehamilan')->orderBy('updated_at', 'desc')->get();
        return view('pages.tanya-jawab-non-kehamilan', compact('faqs'));
    }

    public function unduhan()
    {
        $downloads = Download::orderBy('created_at', 'desc')->paginate(9); // Pagination untuk 9 unduhan per halaman
        return view('pages.unduhan', compact('downloads'));
    }

    public function trackDownload($id)
    {
        // Track download access untuk pasien yang login
        if (Auth::check() && Auth::user()->role === 'pasien') {
            $existingRead = DownloadRead::where('download_id', $id)
                                      ->where('user_id', Auth::id())
                                      ->first();
            
            if ($existingRead) {
                // Increment access count for existing reader
                $existingRead->increment('access_count');
            } else {
                // Create new record for first-time reader
                DownloadRead::create([
                    'download_id' => $id,
                    'user_id' => Auth::id(),
                    'access_count' => 1
                ]);
            }
        }

        // Redirect to actual download file
        $download = Download::findOrFail($id);
        return redirect()->away($download->file_link);
    }

    public function pengingat() {
        return view('pages.pengingat');
    }

    public function berita()
    {
        // Ambil semua berita, urutkan berdasarkan yang terbaru ditambahkan
        $allNews = News::orderBy('created_at', 'desc')->paginate(9); 
    
        // Kirim data ke view
        return view('pages.berita', compact('allNews'));
    }

    public function petunjuk()
    {
        return view('pages.petunjuk');
    }

    public function timPengelola()
    {
        return view('pages.tim-pengelola');
    }
}
