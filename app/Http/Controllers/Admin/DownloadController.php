<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::all();
        return view('admin.downloads.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:modul,flayer', 
            'file_link' => 'required|url',
            'image' => 'nullable|image|mimes:webp|max:2048',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('downloads', 'public');
        }
    
        Download::create($data);
    
        return redirect()->route('admin.downloads.index')->with('success', 'Unduhan berhasil ditambahkan. Silahkan Reload Halaman ini untuk menambahkan kembali !!!');
    }

    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:modul,flayer', // Tambahkan validasi kategori
            'file_link' => 'required|url',
            'image' => 'nullable|image|mimes:webp|max:2048',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('downloads', 'public');
        }
    
        $download->update($data);
    
        return redirect()->route('admin.downloads.index')->with('success', 'Unduhan berhasil diperbarui.');
    }

    public function destroy(Download $download)
    {
        if ($download->image) {
            \Storage::delete('public/' . $download->image); // Hapus gambar dari storage
        }

        $download->delete();

        return redirect()->route('admin.downloads.index')->with('success', 'Unduhan berhasil dihapus.');
    }
}