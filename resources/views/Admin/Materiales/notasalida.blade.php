@extends('Admin.Main.main')

@section('title', 'Notas de Salida')

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
  <div></div>
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
        <td class="p-4">
          <div class="flex gap-4">
            <a href="{{ route('materiales.notasalida.show', $nota->id) }}" class="text-blue-600 hover:text-blue-800" title="Ver Nota">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512"><path fill="#09a0ec" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" /></svg>
            </a>
            <a href="{{ route('nota.salida.pdf', $nota->id) }}" class="text-red-600 hover:text-red-800" target="_blank" title="Exportar PDF">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512"><path fill="#ff5252" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z" /></svg>
            </a>
            <button class="text-slate-600 hover:text-slate-800" title="Eliminar">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 448 512"><path fill="#215083" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" /></svg>
            </button>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
