<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:555|unique:news,title',
            'source' => 'nullable|string|max:555',
            'link' => 'required|url',
            'published_at' => 'required|date',
        ], [
            'title.unique' => 'Judul berita sudah ada. Silakan gunakan judul yang berbeda.'
        ]);

        News::create($request->all());
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:555|unique:news,title,' . $news->id,
            'source' => 'nullable|string|max:555',
            'link' => 'required|url',
            'published_at' => 'required|date',
        ], [
            'title.unique' => 'Judul berita sudah ada. Silakan gunakan judul yang berbeda.'
        ]);

        $news->update($request->all());
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}