<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quote' => 'required|string|max:500|unique:testimonials,quote',
            'name' => 'required|string|max:100',
        ], [
            'quote.unique' => 'Testimonial dengan kutipan yang sama sudah ada.'
        ]);

        Testimonial::create($request->all());

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'quote' => 'required|string|max:500|unique:testimonials,quote,' . $testimonial->id,
            'name' => 'required|string|max:100',
        ], [
            'quote.unique' => 'Testimonial dengan kutipan yang sama sudah ada.'
        ]);

        $testimonial->update($request->all());

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil dihapus.');
    }
}