<?php
// filepath: app/Http/Controllers/Admin/ArticleController.php
// Dengan pesan error yang lebih ramah
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\News;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }
    
    // Helper untuk generate slug
    private function generateSlug($title)
    {
        return \Illuminate\Support\Str::slug($title);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'article_type' => 'required|string|in:kehamilan,non-kehamilan',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:webp|max:2048',
        ]);
        $validated['slug'] = $this->generateSlug($validated['title']);
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }
    
        Article::create($validated);
    
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'article_type' => 'required|string|in:kehamilan,non-kehamilan',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:webp|max:2048',
        ]);
        $validated['slug'] = $this->generateSlug($validated['title']);
    
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image && \Storage::exists('public/' . $article->image)) {
                \Storage::delete('public/' . $article->image);
            }
    
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }
    
        $article->update($validated);
    
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    
}