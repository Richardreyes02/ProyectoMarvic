<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaSalidaProducto;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaSalidaProductoController extends Controller
{
    public function index()
    {
        $notas = NotaSalidaProducto::with(['sede', 'usuario'])->orderBy('fecha', 'desc')->get();
        return view('Admin.Productos.NotaSalida', compact('notas'));
    }

    public function indexuser()
    {
        $notas = NotaSalidaProducto::with(['sede', 'usuario'])->orderBy('fecha', 'desc')->get();
        return view('User.Productos.NotaSalida', compact('notas'));
    }

    public function show($id)
    {
        $nota = NotaSalidaProducto::with(['sede', 'usuario', 'detalles.producto'])->findOrFail($id);
        return view('Admin.Productos.detallesNotaSalida', compact('nota'));
    }

    public function exportarPDF($id)
    {
        $nota = NotaSalidaProducto::with(['sede', 'usuario', 'detalles.producto'])->findOrFail($id);

        $pdf = Pdf::loadView('Admin.PDF.notasalidaproducto', compact('nota'))->setPaper('a4');

        return $pdf->stream("NotaSalidaProducto-{$nota->codigo}.pdf");
    }
}
