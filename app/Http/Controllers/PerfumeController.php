<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Perfume;

class PerfumeController extends Controller
{
    public function index()
    {
        $perfumes = Perfume::all();
        return view('perfumes.index', compact('perfumes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perfumes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'genero' => 'required|string|max:50',
            'precio' => 'required|numeric',
            'notas_aroma' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('imagenes', 'public');
            $validated['imagen'] = $imagen;
        }

        Perfume::create($validated);

        return redirect()->route('perfumes.index')->with('success', 'Perfume creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $perfume = Perfume::findOrFail($id);
        return view('perfumes.edit', compact('perfume'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'genero' => 'required|string|max:50',
            'precio' => 'required|numeric',
            'notas_aroma' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $perfume = Perfume::findOrFail($id);

        if ($request->hasFile('imagen')) {
            // Opcional: borrar imagen vieja si existe
            if ($perfume->imagen && \Storage::disk('public')->exists($perfume->imagen)) {
                \Storage::disk('public')->delete($perfume->imagen);
            }

            $imagen = $request->file('imagen')->store('imagenes', 'public');
            $validated['imagen'] = $imagen;
        }

        $perfume->update($validated);

        return redirect()->route('perfumes.index')->with('success', 'Perfume actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $perfume = Perfume::findOrFail($id);

        // Opcional: borrar imagen si existe
        if ($perfume->imagen && \Storage::disk('public')->exists($perfume->imagen)) {
            \Storage::disk('public')->delete($perfume->imagen);
        }

        $perfume->delete();

        return redirect()->route('perfumes.index')->with('success', 'Perfume eliminado correctamente.');
    }
}
