<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaIngresoProducto;
use App\Models\NotaIngresoMaterial;
use App\Models\DetalleNotaIngresoProducto;
use App\Models\Product;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaIngresoProductoController extends Controller
{
    public function index()
    {
        $notas = NotaIngresoProducto::with('sede', 'usuario')->orderBy('fecha', 'desc')->get();
        return view('Admin.productos.notaingreso', compact('notas'));
    }

    public function indexuser()
    {
        $sedes = Sede::all();
        $productos = Product::all();
        $usuarios = User::all();
        $notas = NotaIngresoProducto::with('sede', 'usuario')->orderBy('fecha', 'desc')->get();
        
        return view('User.Productos.notaingreso', compact('notas', 'sedes', 'productos', 'usuarios'));

    }

    public function exportarPDF($id)
    {
        $nota = NotaIngresoProducto::with(['sede', 'usuario', 'detalles.producto'])->findOrFail($id);

        $pdf = Pdf::loadView('Admin.PDF.notaingresoproducto', compact('nota'))->setPaper('a4');

        return $pdf->stream("NotaIngreso-{$nota->codigo}.pdf");

    }

    public function show($id)
    {
        $nota = NotaIngresoProducto::with([
            'sede',
            'usuario',
            'detalles.producto'
        ])->findOrFail($id);

        return view('admin.productos.detallesnotaingreso', compact('nota'));
    }

    public function store(Request $request)
    {
        // Ejecutar todo dentro de una transacción para evitar condiciones de carrera
        $nota = DB::transaction(function () use ($request) {
            // Bloquear la fila de la última nota para evitar duplicados
            $ultimaNota = NotaIngresoProducto::lockForUpdate()->orderBy('id', 'desc')->first();
            $ultimoNumero = 0;

            if ($ultimaNota && preg_match('/NIP(\d+)/', $ultimaNota->codigo, $matches)) {
                $ultimoNumero = (int) $matches[1];
            }

            $nuevoCodigo = 'NIP' . str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

            // Crear la nota dentro de la transacción
            $nota = NotaIngresoProducto::create([
                'sede_id' => $request->sede_id,
                'usuario_id' => $request->usuario_id,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'observaciones' => $request->observaciones,
                'estado' => 'pendiente',
                'fecha' => now(),
                'codigo' => $nuevoCodigo,
            ]);

            // Agregar los detalles
            $detalles = json_decode($request->input('detalles'), true);

            foreach ($detalles as $item) {
                DetalleNotaIngresoProducto::create([
                    'nota_ingreso_producto_id' => $nota->id,
                    'product_id' => $item['producto_id'],
                    'cantidad' => $item['cantidad'],
                ]);

                Product::where('id', $item['producto_id'])->increment('cantidad', $item['cantidad']);
            }

            return $nota;
        });

        return response()->json(['message' => 'Registro exitoso', 'nota_ingreso_id' => $nota->id]);
    }
}
