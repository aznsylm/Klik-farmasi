<?php
// filepath: app/Http/Controllers/Admin/ArticleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\News;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles')); 
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:webp|max:2048', // Hanya menerima format .webp
        ]);
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }
    
        Article::create($validated);
    
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:webp|max:2048', // Hanya menerima format .webp
        ]);
    
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image && \Storage::exists('public/' . $article->image)) {
                \Storage::delete('public/' . $article->image);
            }
    
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }
    
        $article->update($validated);
    
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    
}