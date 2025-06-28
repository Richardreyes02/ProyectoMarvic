<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\NotaSalidaProducto;
use App\Models\DetalleNotaSalidaProducto;
use App\Models\DetalleNotaSalidaMaterial;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $mes = Carbon::now()->month;
        $anio = Carbon::now()->year;

        // Total salidas este mes
        $totalSalidasMes = (int) DB::table('detalle_notas_salida_productos')
            ->join('notas_salida_productos', 'detalle_notas_salida_productos.nota_salida_id', '=', 'notas_salida_productos.id')
            ->whereMonth('notas_salida_productos.fecha', $mes)
            ->whereYear('notas_salida_productos.fecha', $anio)
            ->sum('detalle_notas_salida_productos.cantidad');

        // Producto con menor stock
        $productoMenorStock = Product::orderBy('cantidad')->first();

        // Producto más salido (top 1 del mes)
        $productoMasSalido = DB::table('detalle_notas_salida_productos')
            ->join('notas_salida_productos', 'detalle_notas_salida_productos.nota_salida_id', '=', 'notas_salida_productos.id')
            ->join('products', 'detalle_notas_salida_productos.producto_id', '=', 'products.id')
            ->whereMonth('notas_salida_productos.fecha', $mes)
            ->whereYear('notas_salida_productos.fecha', $anio)
            ->select('products.descripcion', DB::raw('SUM(detalle_notas_salida_productos.cantidad) as total'))
            ->groupBy('products.descripcion')
            ->orderByDesc('total')
            ->first();

        // Top 5 productos con menos stock
        $productosMenorStock = Product::select('descripcion', 'cantidad')
            ->orderBy('cantidad', 'asc')
            ->limit(5)
            ->get();

        // Top 5 materiales con menos stock
        $materialesMenorStock = DB::table('materials')
            ->select('nombre', 'stock', 'unidad_medida')
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        // 🔹 Top 5 productos más salidos este mes
        $topProductos = DetalleNotaSalidaProducto::select('producto_id', DB::raw('SUM(cantidad) as total'))
            ->whereHas('notaSalida', function ($query) use ($mes, $anio) {
                $query->whereMonth('fecha', $mes)
                    ->whereYear('fecha', $anio);
            })
            ->with('producto')
            ->groupBy('producto_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topProductosLabels = $topProductos->pluck('producto.descripcion');
        $topProductosValores = $topProductos->pluck('total');

        // 🔹 Top 5 materiales más salidos este mes
        $topMateriales = DetalleNotaSalidaMaterial::select('material_id', DB::raw('SUM(cantidad) as total'))
            ->whereHas('notaSalida', function ($query) use ($mes, $anio) {
                $query->whereMonth('fecha', $mes)
                    ->whereYear('fecha', $anio);
            })
            ->with('material')
            ->groupBy('material_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topMaterialesLabels = $topMateriales->pluck('material.nombre');
        $topMaterialesValores = $topMateriales->pluck('total');

        return view('Admin.reportes.reportes', compact(
            'totalSalidasMes',
            'productoMenorStock',
            'productoMasSalido',
            'productosMenorStock',
            'materialesMenorStock',
            'topProductosLabels',
            'topProductosValores',
            'topMaterialesLabels',
            'topMaterialesValores'
        ));
    }

}
