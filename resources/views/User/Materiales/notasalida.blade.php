@extends('Main.User.mainuser')

@section('title', 'Nota de Salida de Materiales')

@section('content')

<div class="w-full grid grid-cols-3 items-center mb-3 mt-1 pl-3">
  <!-- Izquierda -->
  <div>
    <h1 class="text-2xl font-bold text-slate-800">Materiales</h1>
    <p class="text-slate-500">Nota de Salida de Materiales</p>
    
  </div>

  <!-- Centro -->
  <div class="justify-self-center max-w-xl w-full">
    <label for="table-search" class="sr-only">Buscar</label>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 
          4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
      </div>
      <input type="text" id="table-search" class="block w-full p-2 ps-10 text-sm text-gray-600 border border-gray-300 rounded-lg bg-gray-50" placeholder="Buscar...">
    </div>
  </div>

  <!-- Derecha -->
  <div class="ml-10">
    <button onclick="mostrarModalNotaSalida()" 
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Agregar Nota de Salida
    </button>
  </div>
</div>

<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
  <table class="w-full text-left table-auto min-w-max">
    <thead>
      <tr>
        <th class="p-4 border-b border-slate-300 bg-slate-50 text-sm font-bold text-slate-500">Nota de Salida</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50 text-sm font-bold text-slate-500">Documento Relacionado</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50 text-sm font-bold text-slate-500">Fecha</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50 text-sm font-bold text-slate-500">Sede</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50 text-sm font-bold text-slate-500">Usuario</th>
        <th class="p-2 border-b border-slate-300 bg-slate-50 text-sm font-bold text-slate-500">Estado</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($notas as $nota)
      <tr>
        <td class="p-4 block font-semibold text-sm text-slate-600">{{ $nota->codigo }}</td>
        <td class="p-4 text-sm text-slate-600">{{ $nota->numero_documento }}</td>
        <td class="p-4 text-sm text-slate-600">{{ \Carbon\Carbon::parse($nota->fecha)->format('Y-m-d') }}</td>
        <td class="p-4 text-sm text-slate-600">{{ $nota->sede->nombre ?? 'N/A' }}</td>
        <td class="p-4 text-sm text-slate-600">{{ $nota->usuario->name ?? 'N/A' }}</td>
        <td class="p-2">
          @php
            $estadoColor = match($nota->estado) {
              'confirmado' => 'green',
              'pendiente' => 'yellow',
              'anulado' => 'red',
              default => 'gray'
            };
          @endphp
          <span class="inline-flex items-center text-{{ $estadoColor }}-800 text-xs font-medium px-2.5 py-0.5 rounded-full bg-{{ $estadoColor }}-100">
            <span class="w-3 h-3 me-1 bg-{{ $estadoColor }}-500 rounded-full"></span>
            {{ ucfirst($nota->estado) }}
          </span>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal Nota Salida -->
<div id="modalNotaSalida" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full relative">
        
        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Registrar Nota de Salida</h2>
        
        <form>
            <!-- Fecha -->
            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="mt-1 block w-full border-gray-300 rounded p-2" readonly>
            </div>

            <!-- Tipo de Documento -->
            <div class="mb-4">
                <label for="tipo_documento" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
                <input type="text" id="tipo_documento" name="tipo_documento" class="mt-1 block w-full border-gray-300 rounded p-2" readonly>
            </div>

            <!-- Número de Documento -->
            <div class="mb-4">
                <label for="numero_documento" class="block text-sm font-medium text-gray-700">Número de Documento</label>
                <input type="text" id="numero_documento" name="numero_documento" class="mt-1 block w-full border-gray-300 rounded p-2" readonly>
            </div>

            <!-- Usuario -->
            <div class="mb-4">
                <label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
                <input type="text" id="usuario" name="usuario" class="mt-1 block w-full border-gray-300 rounded p-2" readonly>
            </div>

            <!-- Sede -->
            <div class="mb-4">
                <label for="sede" class="block text-sm font-medium text-gray-700">Sede</label>
                <input type="text" id="sede" name="sede" class="mt-1 block w-full border-gray-300 rounded p-2" readonly>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 mt-6">
                <button type="button" onclick="ocultarModalNotaSalida()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancelar
                </button>
                <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Guardar Nota
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS simple para mostrar/ocultar el modal -->
<script>
    function mostrarModalNotaSalida() {
        document.getElementById('modalNotaSalida').classList.remove('hidden');
    }

    function ocultarModalNotaSalida() {
        document.getElementById('modalNotaSalida').classList.add('hidden');
    }
</script>



<script>
    function mostrarModalNotaSalida() {
        document.getElementById('modalNotaSalida').classList.remove('hidden');
    }

    function ocultarModalNotaSalida() {
        document.getElementById('modalNotaSalida').classList.add('hidden');
    }
</script>


@endsection
