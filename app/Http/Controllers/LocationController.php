<?php

namespace App\Http\Controllers;

use App\Models\Location; // <-- Ganti
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocationController extends Controller
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
        $locations = Location::latest()->get(); // <-- Ganti
        return view('locations.index', compact('locations')); // <-- Ganti
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create'); // <-- Ganti
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:locations', // <-- Ganti
        ]);

        Location::create($validatedData); // <-- Ganti

        return redirect()->route('locations.index') // <-- Ganti
                         ->with('success', 'Lokasi baru berhasil ditambahkan!'); // <-- Ganti
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location) // <-- Ganti
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location) // <-- Ganti
    {
        return view('locations.edit', compact('location')); // <-- Ganti
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location) // <-- Ganti
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('locations')->ignore($location->id), // <-- Ganti
            ],
        ]);

        $location->update($validatedData); // <-- Ganti

        return redirect()->route('locations.index') // <-- Ganti
                         ->with('success', 'Lokasi berhasil di-update!'); // <-- Ganti
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location) // <-- Ganti
    {
        // Cek dulu apakah ada aset yang masih pakai lokasi ini
        if ($location->assets()->count() > 0) {
            return redirect()->route('locations.index')
                             ->with('error', 'Lokasi tidak bisa dihapus karena masih digunakan oleh aset.');
        }

        $location->delete(); // <-- Ganti

        return redirect()->route('locations.index') // <-- Ganti
                         ->with('success', 'Lokasi berhasil dihapus!'); // <-- Ganti
    }
}
