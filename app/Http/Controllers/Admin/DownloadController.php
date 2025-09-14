<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::orderBy('created_at', 'desc')->get(); 
        return view('admin.downloads.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:downloads,title',
            'description' => 'required|string',
            'file_link' => 'required|url',
            'image' => 'nullable|image|mimes:webp|max:2048',
        ], [
            'title.unique' => 'Judul unduhan sudah ada. Silakan gunakan judul yang berbeda.',
            'image.mimes' => 'Format gambar harus webp.'
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('downloads', 'public');
        }
    
        Download::create($data);
    
        return redirect()->route('admin.unduhan.index')->with('success', 'Unduhan berhasil ditambahkan. Silahkan Reload Halaman ini untuk menambahkan kembali !!!');
    }

    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:downloads,title,' . $download->id,
            'description' => 'required|string',
            'file_link' => 'required|url',
            'image' => 'nullable|image|mimes:webp|max:2048',
        ], [
            'title.unique' => 'Judul unduhan sudah ada. Silakan gunakan judul yang berbeda.',
            'image.mimes' => 'Format gambar harus webp.'
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('downloads', 'public');
        }
    
        $download->update($data);
    
        return redirect()->route('admin.unduhan.index')->with('success', 'Unduhan berhasil diperbarui.');
    }

    public function destroy(Download $download)
    {
        if ($download->image) {
            \Storage::delete('public/' . $download->image); // Hapus gambar dari storage
        }

        $download->delete();

        return redirect()->route('admin.unduhan.index')->with('success', 'Unduhan berhasil dihapus.');
    }
}