<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('Materials.materials', compact('materials'));
    }

    public function indexUser()
    {
        $materials = Material::all();
        return view('User.Materiales.materiales', compact('materials'));
    }

    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'unit' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Crear un nuevo material en la base de datos
        $material = new Material();
        $material->nombre = $validated['name'];
        $material->descripcion = $validated['description'];
        $material->stock = $validated['stock'];
        $material->unidad_medida = $validated['unit'];
        $material->save();

        // Retornar una respuesta JSON con los datos del nuevo material
        return response()->json([
            'success' => true,
            'material' => $material
        ]);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'unit' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ]);

        $material = Material::findOrFail($id);

        $material->nombre = $request->input('name');
        $material->stock = $request->input('stock');
        $material->unidad_medida = $request->input('unit');
        $material->descripcion = $request->input('description');

        $material->save();

        return response()->json([
            'success' => true,
            'message' => 'Material actualizado correctamente'
        ]);
        
    }



}
