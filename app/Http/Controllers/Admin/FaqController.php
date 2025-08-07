<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get(); 
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:255|unique:faqs,question',
            'answer' => 'required|string',
        ], [
            'question.unique' => 'Pertanyaan ini sudah ada. Silakan gunakan pertanyaan yang berbeda.'
        ]);

        Faq::create($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'Tanya Jawab berhasil ditambahkan.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:255|unique:faqs,question,' . $faq->id,
            'answer' => 'required|string',
        ], [
            'question.unique' => 'Pertanyaan ini sudah ada. Silakan gunakan pertanyaan yang berbeda.'
        ]);

        $faq->update($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'Tanya Jawab berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'Tanya Jawab berhasil dihapus.');
    }
}