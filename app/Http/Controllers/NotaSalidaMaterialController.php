<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaSalidaMaterial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaSalidaMaterialController extends Controller
{
    public function index()
    {
        $notas = NotaSalidaMaterial::with(['sede', 'usuario'])->orderBy('fecha', 'desc')->get();
        return view('Admin.Materiales.NotaSalida', compact('notas'));
    }
    
    public function indexuser()
    {
        $notas = NotaSalidaMaterial::with(['sede', 'usuario'])->orderBy('fecha', 'desc')->get();
        return view('User.Materiales.NotaSalida', compact('notas'));
    }



    public function show($id)
    {
        $nota = NotaSalidaMaterial::with(['sede', 'usuario', 'detalles.material'])->findOrFail($id);
        return view('Admin.Materiales.detallesNotaSalida', compact('nota'));
    }

    public function exportarPDF($id)
    {
        $nota = NotaSalidaMaterial::with(['sede', 'usuario', 'detalles.material'])->findOrFail($id);

        $pdf = Pdf::loadView('Admin.PDF.notasalidamaterial', compact('nota'))->setPaper('a4');

        return $pdf->stream("NotaSalida-{$nota->codigo}.pdf");

    }
}
