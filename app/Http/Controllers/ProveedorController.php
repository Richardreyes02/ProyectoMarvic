<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all(); // Traer todos los proveedores
        return view('Admin.proveedores.proveedores', compact('proveedores'));
    }

    public function destroy($id)
    {
        Proveedor::destroy($id);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }

}
