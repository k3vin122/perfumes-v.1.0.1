<?php

namespace App\Http\Controllers;

use App\Models\Dinerobanco;
use Illuminate\Http\Request;

class DinerobancoController extends Controller
{
    // Mostrar todos los registros
    public function index()
    {
        // Obtener todos los registros
        $dinerobanco = Dinerobanco::all();
        return view('dinerobanco.index', compact('dinerobanco'));  // Enviar los datos a la vista
    }



    
    // Mostrar el formulario para crear un nuevo registro
    public function create()
    {
        return view('dinerobanco.create');
    }

    // Guardar un nuevo registro
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'dinero' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo registro
        Dinerobanco::create([
            'dinero' => $request->dinero,
        ]);

        return redirect()->route('dinerobanco.index')->with('success', 'Registro creado exitosamente!');
    }

    // Mostrar un registro específico
    public function show($id)
    {
        // Obtener el registro por ID
        $dinerobanco = Dinerobanco::findOrFail($id);
        return view('dinerobanco.show', compact('dinerobanco'));  // Pasar los datos a la vista
    }

    // Mostrar el formulario para editar un registro
    public function edit($id)
    {
        // Obtener el registro por ID
        $dinerobanco = Dinerobanco::findOrFail($id);
        return view('dinerobanco.edit', compact('dinerobanco'));  // Pasar los datos a la vista
    }

    // Actualizar un registro existente
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'dinero' => 'required|numeric|min:0',
        ]);

        // Obtener el registro por ID y actualizar
        $dinerobanco = Dinerobanco::findOrFail($id);
        $dinerobanco->dinero = $request->dinero;
        $dinerobanco->save();

        return redirect()->route('dinerobanco.index')->with('success', 'Registro actualizado exitosamente!');
    }

    // Eliminar un registro
    public function destroy($id)
    {
        // Obtener el registro por ID y eliminar
        $dinerobanco = Dinerobanco::findOrFail($id);
        $dinerobanco->delete();

        return redirect()->route('dinerobanco.index')->with('success', 'Registro eliminado exitosamente!');
    }
}