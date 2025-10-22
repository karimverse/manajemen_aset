<?php

// PERBAIKAN 1: Namespace yang benar
namespace App\Http\Controllers;

// PERBAIKAN 2: Impor Base Controller
use App\Http\Controllers\Controller; // <-- TAMBAHKAN INI

// ... (Use statements lain sudah benar) ...
use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\AssetHistory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Illuminate\Support\Facades\Storage;

class AssetController extends Controller // <-- Sekarang dia kenal 'Controller'
{
    public function __construct()
    {
        $this->middleware('can:is-admin')->except(['index', 'show', 'generateQrCodeWithLogo']);
    }

    public function index(Request $request)
    {
        $query = Asset::with(['category', 'location']);

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('asset_code', 'like', "%{$search}%");
            });
        }

        $assets = $query->latest()->paginate(10);

        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('assets.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'asset_code' => 'required|string|max:255|unique:assets',
            'description' => 'nullable|string',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0',
            'status' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
        ]);

        $asset = Asset::create($validatedData);

        AssetHistory::create([
            'asset_id' => $asset->id,
            'user_id' => Auth::id(),
            'action' => 'Dibuat',
            'notes' => 'Aset baru ditambahkan ke dalam sistem.'
        ]);

        return redirect()->route('assets.index')
                         ->with('success', 'Aset baru berhasil ditambahkan!');
    }

    public function show(Asset $asset)
    {
        $asset->load(['category', 'location', 'histories.user']);
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('assets.edit', compact('asset', 'categories', 'locations'));
    }

    public function update(Request $request, Asset $asset)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'asset_code' => ['required','string','max:255', Rule::unique('assets')->ignore($asset->id)],
            'description' => 'nullable|string',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0',
            'status' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
        ]);

        $asset->update($validatedData);

        AssetHistory::create([
            'asset_id' => $asset->id,
            'user_id' => Auth::id(),
            'action' => 'Diperbarui',
            'notes' => 'Data aset telah di-update.'
        ]);

        return redirect()->route('assets.index')
                         ->with('success', 'Aset berhasil di-update!');
    }

    public function destroy(Asset $asset)
    {
        AssetHistory::create([
            'asset_id' => $asset->id,
            'user_id' => Auth::id(),
            'action' => 'Dihapus',
            'notes' => 'Aset telah dihapus dari sistem.'
        ]);

        $asset->delete();

        return redirect()->route('assets.index')
                         ->with('success', 'Aset berhasil dihapus!');
    }

} // <-- Pastikan kurung kurawal penutup class ada
