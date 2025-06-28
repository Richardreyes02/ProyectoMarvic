@extends('Admin.Main.main')

@section('title', 'Detalle Nota de Salida')

@section('content')

<div class="p-6 bg-white rounded-lg shadow max-w-5xl mx-auto relative">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-extrabold text-center flex-grow text-gray-800">MARVIC SAC</h1>
    </div>

    <div class="w-full text-center mb-6">
        <h2 class="text-xl font-semibold text-gray-700 inline-block">
            NOTA DE SALIDA PRODUCTO - {{ $nota->codigo }}
        </h2>
    </div>

    <!-- Datos principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Destino</label>
            <input id="sede" type="text" value="{{ $nota->sede->nombre ?? 'N/A' }}" readonly
                class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-700 cursor-not-allowed" />
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Responsable</label>
            <input id="usuario" type="text" value="{{ $nota->usuario->name ?? 'N/A' }}" readonly
                class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-700 cursor-not-allowed" />
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Tipo Documento</label>
            <input type="text" value="{{ $nota->tipo_documento }}" readonly
                class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-700" />
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Número Documento</label>
            <input type="text" value="{{ $nota->numero_documento }}" readonly
                class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-700" />
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Fecha</label>
            <input type="text" value="{{ \Carbon\Carbon::parse($nota->fecha)->format('d/m/Y') }}" readonly
                class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-700" />
        </div>
    </div>

    <!-- Observaciones -->
    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900">Observaciones</label>
        <textarea rows="4" readonly
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
            {{ $nota->observaciones ?? '-' }}
        </textarea>
    </div>

    <!-- Detalles de materiales -->
    <h3 class="text-lg font-semibold mb-4 text-gray-700">Detalles de Materiales</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-600 uppercase">
                <tr>
                    <th class="px-4 py-3 border">Producto</th>
                    <th class="px-4 py-3 border">Cantidad</th>
                    <th class="px-4 py-3 border">U/M</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nota->detalles as $detalle)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $detalle->producto->descripcion ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $detalle->cantidad }}</td>
                        <td class="px-4 py-2 border">unidades</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botón regresar -->
    <div class="mt-6 text-right">
        <a href="{{ route('productos.notasalida.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-sm font-medium rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            ← Regresar
        </a>
    </div>
</div>

@endsection
