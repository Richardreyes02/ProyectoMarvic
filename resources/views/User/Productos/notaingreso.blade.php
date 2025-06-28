@extends('Admin.Main.main')

@section('title', 'Notas de Ingreso de Productos')

@section('content')

<div class="w-full grid grid-cols-3 items-center mb-3 mt-1 pl-3">
  <div>
    <h1 class="text-2xl font-bold text-slate-800">Productos</h1>
    <p class="text-slate-500">Nota de Ingreso de Productos</p>
  </div>

  <div class="justify-self-center max-w-xl w-full">
    <label for="table-search" class="sr-only">Search</label>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
        </svg>
      </div>
      <input type="text" id="table-search" class="block w-full p-2 ps-10 text-sm text-gray-600 border border-gray-300 rounded-lg bg-gray-50" placeholder="Buscar...">
    </div>
  </div>
  
  <div class="text-right pr-4">
  <button data-modal-target="modalNotaIngresoProducto" data-modal-toggle="modalNotaIngresoProducto"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    Agregar Nota de Ingreso
  </button>
</div>

</div>

<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
  <table class="w-full text-left table-auto min-w-max">
    <thead>
      <tr>
        <th class="p-4 border-b border-slate-300 bg-slate-50">Nota de Ingreso</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50">Documento</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50">Fecha</th>
        <th class="p-4 border-b border-slate-300 bg-slate-50">Sede</th>
        <th class="p-2 border-b border-slate-300 bg-slate-50">Estado</th>
      </tr>
    </thead>
    <tbody>
      @foreach($notas as $nota)
      <tr class="hover:bg-gray-100">
        <td class="p-4">{{ $nota->codigo }}</td>
        <td class="p-4">{{ $nota->numero_documento }}</td>
        <td class="p-4">{{ \Carbon\Carbon::parse($nota->fecha)->format('Y-m-d') }}</td>
        <td class="p-4">{{ $nota->sede->nombre ?? 'N/A' }}</td>
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

<!-- Modal Nota de Ingreso de Productos -->
<div id="modalNotaIngresoProducto" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full overflow-x-hidden overflow-y-auto h-modal md:h-full">
  <div class="relative p-4 w-full max-w-5xl h-full md:h-auto">
    <div class="relative bg-white rounded-lg shadow max-h-[80vh] overflow-y-auto px-8 py-6">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-extrabold text-center flex-grow text-gray-800">MARVIC SAC</h1>
      </div>

      <div class="w-full text-center mb-6">
        <h2 class="text-xl font-semibold text-gray-700">REGISTRAR NOTA DE INGRESO PRODUCTO</h2>
      </div>

      <form id="formNotaIngresoProducto" action="{{ route('productos.notaingreso.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div>
            <label class="block mb-1 font-semibold text-gray-700">Sede</label>
            <select name="sede_id" class="w-full p-2 border border-gray-300 rounded bg-white text-gray-700" required>
              <option value="">Seleccione una sede</option>
              @foreach($sedes as $sede)
                <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block mb-1 font-semibold text-gray-700">Encargado</label>
            <input type="text" class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-700" value="{{ auth()->user()->name }}" disabled>
            <input type="hidden" name="usuario_id" value="{{ auth()->user()->id }}">
          </div>

          <div>
            <label class="block mb-1 font-semibold text-gray-700">Tipo Documento</label>
            <input name="tipo_documento" type="text" class="w-full p-2 border border-gray-300 rounded bg-white text-gray-700" />
          </div>

          <div>
            <label class="block mb-1 font-semibold text-gray-700">Número Documento</label>
            <input name="numero_documento" type="text" class="w-full p-2 border border-gray-300 rounded bg-white text-gray-700" />
          </div>
        </div>

        <div class="mb-6">
          <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900">Observaciones</label>
          <textarea name="observaciones" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Producto</label>
            <select name="producto_id" id="producto_id" class="w-full border-gray-300 rounded p-2">
              <option value="">Seleccione un producto</option>
              @foreach($productos as $producto)
                <option value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="w-full border-gray-300 rounded p-2" min="1">
          </div>

          <div>
          <button type="button" id="agregar-producto-btn" class="px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
            Agregar Producto
          </button>
        </div>

        </div>

        <input type="hidden" name="detalles" id="detalles-productos-json">

        <div class="mt-4">
          <h3 class="text-lg font-semibold mb-2">Detalle de Productos Agregados</h3>
          <div class="relative overflow-x-auto rounded-xl border border-gray-200 shadow-sm mt-2">
            <table class="w-full text-sm text-left text-gray-500" id="tabla-productos">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th class="px-6 py-3">Descripción</th>
                  <th class="px-6 py-3 text-center">Cantidad</th>
                </tr>
              </thead>
              <tbody id="detalle-productos-body">
                <!-- dinámico -->
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-6 flex justify-end gap-4">
          <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded hover:bg-gray-400" data-modal-hide="modalNotaIngresoProducto">
            Cancelar
          </button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
            Guardar Nota
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formNotaIngresoProducto');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // evitar que se envíe de forma tradicional

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                // Cierra el modal con Flowbite
                const modal = document.getElementById('modalNotaIngresoProducto');
                modal.classList.add('hidden');

                // Limpia el formulario y la tabla
                form.reset();
                document.getElementById('detalle-productos-body').innerHTML = '';
                document.getElementById('detalles-productos-json').value = '';

                // Opcional: recargar tabla con nueva data (puedes hacer un fetch para actualizar si deseas)
                location.reload(); // si deseas recargar la página
            }
        })
        .catch(error => {
            console.error('Error al guardar:', error);
            alert('Ocurrió un error al guardar.');
        });
    });
});
</script>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const productos = @json($productos);
    const selectProducto = document.getElementById('producto_id');
    const cantidadInput = document.getElementById('cantidad');
    const agregarBtn = document.getElementById('agregar-producto-btn');
    const detalleBody = document.getElementById('detalle-productos-body');
    const inputJson = document.getElementById('detalles-productos-json');

    let listaProductos = [];

    agregarBtn.addEventListener('click', () => {
      const productoId = selectProducto.value;
      const cantidad = parseFloat(cantidadInput.value);
      const producto = productos.find(p => p.id == productoId);

      if (!productoId || !cantidad || cantidad <= 0) {
        alert('Complete correctamente los campos');
        return;
      }

      listaProductos.push({
        producto_id: producto.id,
        descripcion: producto.descripcion,
        cantidad: cantidad,
      });

      selectProducto.value = '';
      cantidadInput.value = '';
      renderizarTabla();
    });

    function renderizarTabla() {
      detalleBody.innerHTML = '';
      listaProductos.forEach(item => {
        const row = document.createElement('tr');
        row.className = "bg-white hover:bg-gray-50";
        row.innerHTML = `
          <td class="px-6 py-3 font-medium text-gray-900">${item.descripcion}</td>
          <td class="px-6 py-3 text-center text-gray-500">${item.cantidad}</td>
        `;
        detalleBody.appendChild(row);
      });
      inputJson.value = JSON.stringify(listaProductos);
    }
  });
</script>


@endsection
