<?php

namespace App\Http\Controllers;
use App\Models\NotaIngresoMaterial;
use App\Models\DetalleNotaIngresoMaterial;
use App\Models\Proveedor;
use App\Models\Sede;
use App\Models\User;
use App\Models\Material; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Http\Request;

class NotaIngresoMaterialController extends Controller
{
    public function index()
    {
        $notas = NotaIngresoMaterial::with(['proveedor', 'sede'])->get(); // Eager loading

        return view('admin.materiales.notaingreso', compact('notas'));
    }

    public function indexuser()
    {
        $notas = NotaIngresoMaterial::with(['proveedor', 'sede'])->get();
        $proveedores = Proveedor::all();
        $usuarios = User::all();
        $sedes = Sede::all();
        $materials = Material::all(); // ¡AGREGA ESTO!

        return view('user.materiales.notaingreso', compact('notas', 'proveedores', 'usuarios', 'sedes', 'materials'));
    }


    public function exportarPDF($id)
    {
        $nota = NotaIngresoMaterial::with(['proveedor', 'sede', 'usuario', 'detalles.material'])->findOrFail($id);

        $pdf = Pdf::loadView('Admin.PDF.notaingresomaterial', compact('nota'))->setPaper('a4');

        return $pdf->stream("NotaIngreso-{$nota->codigo}.pdf");

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'tipo_documento' => 'required|string',
            'numero_documento' => 'required|string',
            'usuario_id' => 'required|exists:users,id',
            'sede_id' => 'required|exists:sedes,id',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:pendiente,confirmado,anulado',
            'detalles' => 'required|string' // llega como JSON string
        ]);

        $lastNota = NotaIngresoMaterial::orderBy('id', 'desc')->first();
        $codigo = $lastNota 
            ? 'NIM' . str_pad(((int) substr($lastNota->codigo, 3)) + 1, 3, '0', STR_PAD_LEFT) 
            : 'NIM001';

        DB::beginTransaction();

        try {
            $nota = NotaIngresoMaterial::create([
                'codigo'            => $codigo,
                'proveedor_id'      => $request->proveedor_id,
                'usuario_id'        => $request->usuario_id,
                'estado'            => $request->estado,
                'tipo_documento'    => $request->tipo_documento,
                'numero_documento'  => $request->numero_documento,
                'fecha'             => Carbon::now(),
                'observaciones'     => $request->observaciones,
                'sede_id'           => $request->sede_id
            ]);

            $detalles = json_decode($request->detalles, true);

            if ($detalles && is_array($detalles)) {
                foreach ($detalles as $detalle) {
                    // Crear el detalle
                    DetalleNotaIngresoMaterial::create([
                        'nota_ingreso_id' => $nota->id,
                        'material_id'     => $detalle['material_id'],
                        'cantidad'        => $detalle['cantidad'],
                        'unidad_medida'   => $detalle['unidad_medida'],
                        'costo_unitario'  => $detalle['costo_unitario'],
                        'subtotal'        => $detalle['subtotal'],
                    ]);

                    $material = Material::find($detalle['material_id']);
                    if ($material) {
                        $material->stock += $detalle['cantidad'];
                        $material->save();
                    }
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'nota_ingreso_id' => $nota->id]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Error al guardar la nota: ' . $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        $nota = NotaIngresoMaterial::with([
            'proveedor',
            'sede',
            'usuario',
            'detalles.material'
        ])->findOrFail($id);

        return view('admin.materiales.detallesnotaingreso', compact('nota'));
    }


}