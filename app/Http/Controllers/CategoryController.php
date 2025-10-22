<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Penting untuk validasi update

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:is-admin')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * (Kita tidak pakai halaman show untuk kategori, jadi bisa dikosongi)
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Laravel otomatis mencari kategori berdasarkan ID di URL
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id), // Validasi unik tapi abaikan diri sendiri
            ],
        ]);

        $category->update($validatedData);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil di-update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Cek dulu apakah ada aset yang masih pakai kategori ini
        if ($category->assets()->count() > 0) {
            return redirect()->route('categories.index')
                             ->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh aset.');
        }

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}
