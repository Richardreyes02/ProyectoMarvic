@extends('Main.User.mainuser')

@section('title', 'Materiales')

@section('content')
<div class="w-full grid grid-cols-3 items-center mb-3 mt-1 pl-3">
  <div>
    <h1 class="text-2xl font-bold text-slate-800">Materiales</h1>
    <p class="text-slate-500">Nota de Ingreso de Materiales</p>
  </div>
  <div class="justify-self-center max-w-xl w-full">
    <label for="table-search" class="sr-only">Buscar</label>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <input type="text" id="table-search" class="block w-full p-2 ps-10 text-sm text-gray-600 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Buscar material..." />
    </div>
  </div>
  <div class="text-right pr-4">
    <button data-modal-target="modalNotaIngreso" data-modal-toggle="modalNotaIngreso"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
      Agregar Nota de Ingreso
    </button>
  </div>
</div>

<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
  <table class="w-full text-left table-auto min-w-max">
    <thead>
      <tr>
        <th class="p-4 border-b border-slate-300 bg-slate-50"><p class="text-sm font-bold text-slate-500">Nota de Ingreso</p></th>
        <th class="p-4 border-b border-slate-300 bg-slate-50"><p class="text-sm font-bold text-slate-500">Proveedor</p></th>
        <th class="p-4 border-b border-slate-300 bg-slate-50"><p class="text-sm font-bold text-slate-500">Documento relacionado</p></th>
        <th class="p-4 border-b border-slate-300 bg-slate-50"><p class="text-sm font-bold text-slate-500">Fecha de Emisión</p></th>
        <th class="p-4 border-b border-slate-300 bg-slate-50"><p class="text-sm font-bold text-slate-500">Sede</p></th>
        <th class="p-2 border-b border-slate-300 bg-slate-50"><p class="text-sm font-bold text-slate-500">Estado</p></th>
        <th class="p-4 border-b border-slate-300 bg-slate-50"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($notas as $nota)
      <tr>
        <td class="p-4 py-5 text-sm text-slate-600 font-semibold">{{ $nota->codigo }}</td>
        <td class="p-4 py-5 text-sm text-slate-600">{{ $nota->proveedor->razon_social ?? 'N/A' }}</td>
        <td class="p-4 py-5 text-sm text-slate-600">{{ $nota->numero_documento }}</td>
        <td class="p-4 py-5 text-sm text-slate-600">{{ \Carbon\Carbon::parse($nota->fecha)->format('Y-m-d') }}</td>
        <td class="p-4 py-5 text-sm text-slate-600">{{ $nota->sede->nombre ?? 'N/A' }}</td>
        <td class="p-2 py-5">
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
        <td class="p-4 py-5">
          <div class="flex justify-start gap-6">
            <a href="{{ route('materiales.notaingreso.show', $nota->id) }}" class="text-slate-600 hover:text-slate-800" title="Ver Nota">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512"><path fill="#09a0ec" d="..."/></svg>
            </a>
            <a href="{{ route('nota.ingreso.pdf', $nota->id) }}" class="text-slate-600 hover:text-slate-800" target="_blank" title="Exportar PDF">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512"><path fill="#ff5252" d="..."/></svg>
            </a>
            <button class="text-slate-600 hover:text-slate-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 448 512"><path fill="#215083" d="..."/></svg>
            </button>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal Nota de Ingreso (estructura Flowbite, el contenido va dentro sin cambios) -->
<div id="modalNotaIngreso" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-5xl h-full md:h-auto">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-100 max-h-[80vh] overflow-y-auto px-8 py-6">
      <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-extrabold text-center flex-grow text-gray-800">MARVIC SAC</h1>
        </div>

        <div class="w-full text-center mb-6">
            <h2 class="text-xl font-semibold text-gray-700 inline-block">
                REGISTRAR NOTA DE INGRESO MATERIAL
            </h2>
        </div>

        <form id="formNotaIngreso" action="{{ route('notaingreso.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="proveedor">Proveedor</label>
                    <select id="proveedor_id" name="proveedor_id" class="w-full p-2 border border-gray-300 rounded bg-white text-gray-700" required>
                        <option value="">Seleccione un proveedor</option>
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="sede">Sede</label>
                    <select id="sede_id" name="sede_id" class="w-full p-2 border border-gray-300 rounded bg-white text-gray-700" required>
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
                    <label class="block mb-1 font-semibold text-gray-700" for="estado_mostrado">Estado</label>
                    <input id="estado_mostrado" type="text" value="pendiente" 
                        class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-700" disabled>
                    <!-- Campo oculto real que sí se enviará al backend -->
                    <input type="hidden" id="estado" name="estado" value="pendiente">
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="tipo_documento">Tipo Documento</label>
                    <input id="tipo_documento" name="tipo_documento" type="text"
                        class="w-full p-2 border border-gray-300 rounded bg-white text-gray-700" />
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="numero_documento">Número Documento</label>
                    <input id="numero_documento" name="numero_documento" type="text"
                        class="w-full p-2 border border-gray-300 rounded bg-white text-gray-700" />
                </div>
            </div>

            <div class="mb-6">
                <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900">Observaciones</label>
                <textarea id="observaciones" name="observaciones" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Material</label>
                    <select name="material_id" id="material_id" class="w-full border-gray-300 rounded p-2">
                        <option value="">Seleccione un material</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="w-full border-gray-300 rounded p-2" min="1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Unidad</label>
                    <input type="text" name="unidad_medida" id="unidad_medida" class="w-full border-gray-300 rounded p-2" readonly>
                </div>

                <!-- Costo Unitario + Botón Agregar -->
                <div class="flex gap-2 items-end">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700">Costo Unitario</label>
                        <input type="number" step="any" name="costo_unitario" id="costo_unitario" class="w-full border-gray-300 rounded p-2" min="0">
                    </div>
                    <div>
                        <button type="button"
                            id="agregar-material-btn"
                            class="mt-4 px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
                            Agregar Material
                        </button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="detalles" id="detalles-materiales-json">
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Detalle de Materiales Agregados</h3>
                <div class="relative overflow-x-auto rounded-xl border border-gray-200 shadow-sm mt-2">
                    <table class="w-full text-sm text-left text-gray-500" id="tabla-materiales">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Descripción</th>
                            <th class="px-6 py-3 text-center">Cantidad</th>
                            <th class="px-6 py-3 text-center">U/M</th>
                            <th class="px-6 py-3 text-center">Costo Unitario</th>
                            <th class="px-6 py-3 text-center">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody id="detalle-materiales-body">
                        <!-- filas dinámicas aquí -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end pr-4">
                    <span class="text-lg font-semibold text-gray-700">Total: S/ <span id="total-general">0.00</span></span>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button"
                    class="px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded hover:bg-gray-400"
                    data-modal-hide="modalNotaIngreso">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
                    Guardar Nota
                </button>
            </div>
        </form>
    </div>
  </div>
</div>












<script>
    document.addEventListener('DOMContentLoaded', function() {
        const materiales = @json($materials); // datos de materiales desde PHP
        const selectMaterial = document.getElementById('material_id');
        const unidadInput = document.getElementById('unidad_medida');
        const cantidadInput = document.getElementById('cantidad');
        const costoUnitarioInput = document.getElementById('costo_unitario');
        const agregarBtn = document.getElementById('agregar-material-btn');
        const detalleBody = document.getElementById('detalle-materiales-body');

        let listaMateriales = []; // Aquí se almacenarán los materiales agregados

        // Auto-llenado de unidad
        selectMaterial.addEventListener('change', function() {
            const materialId = this.value;
            const material = materiales.find(m => m.id == materialId);

            if (material) {
                unidadInput.value = material.unidad_medida;
            } else {
                unidadInput.value = '';
            }
        });

        // Evento para agregar material a la lista
        agregarBtn.addEventListener('click', function() {
            const materialId = selectMaterial.value;
            const cantidad = parseFloat(cantidadInput.value);
            const costoUnitario = parseFloat(costoUnitarioInput.value);

            // Validaciones básicas
            if (!materialId) {
                alert('Seleccione un material.');
                return;
            }
            if (!cantidad || cantidad <= 0) {
                alert('Ingrese una cantidad válida.');
                return;
            }
            if (!costoUnitario || costoUnitario <= 0) {
                alert('Ingrese un costo unitario válido.');
                return;
            }
            const material = materiales.find(m => m.id == materialId);
            const subtotal = cantidad * costoUnitario;
            // Agregamos el material a la lista
            listaMateriales.push({
                material_id: material.id,
                cantidad: cantidad,
                unidad_medida: material.unidad_medida, // ✅ campo real en la BD
                costo_unitario: costoUnitario,
                subtotal: subtotal
            });
            // Limpiamos los inputs
            selectMaterial.value = '';
            cantidadInput.value = '';
            unidadInput.value = '';
            costoUnitarioInput.value = '';
            // Renderizamos la tabla
            renderizarTabla();
        });
        function renderizarTabla() {
            detalleBody.innerHTML = ''; // Limpiar tabla
            let totalGeneral = 0;

            listaMateriales.forEach(item => {
                const material = materiales.find(m => m.id == item.material_id); // Buscar para mostrar el nombre
                const row = document.createElement('tr');
                row.className = "bg-white hover:bg-gray-50"; // efecto hover como en la tabla original
                row.innerHTML = `
                <td class="px-6 py-3 font-medium text-gray-900">${material ? material.nombre : ''}</td>
                <td class="px-6 py-3 text-center text-gray-500">${item.cantidad}</td>
                <td class="px-6 py-3 text-center text-gray-400">${item.unidad_medida}</td>
                <td class="px-6 py-3 text-center text-gray-500">S/ ${item.costo_unitario.toFixed(2)}</td>
                <td class="px-6 py-3 text-center text-gray-800">S/ ${item.subtotal.toFixed(2)}</td>
                `;

                detalleBody.appendChild(row);
                totalGeneral += item.subtotal;
            });

            // Actualiza el total general
            document.getElementById('total-general').textContent = totalGeneral.toFixed(2);

            // También actualiza el input oculto con el JSON de la lista
            document.getElementById('detalles-materiales-json').value = JSON.stringify(listaMateriales);
        }

    });
</script> 

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formNotaIngreso');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Evita el envío tradicional

        const formData = new FormData(form);

        // Convertimos los datos a un objeto para mostrarlos fácilmente
        let datos = {};
        formData.forEach(function(value, key){
            datos[key] = value;
        });

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud');
            }
            return response.json(); // Cambiar de .text() a .json()
        })
        .then(data => {
            alert('Nota de Ingreso registrada correctamente. ID: ' + data.nota_ingreso_id);
            document.getElementById('modalNotaIngreso').classList.add('hidden');
            location.reload();
        })

        .catch(error => {
            console.error('Error:', error);
            error.text().then(text => console.error("Respuesta completa:", text));
            alert('Ocurrió un error al registrar la Nota de Ingreso.');
        });
    });
});
</script>

@endsection
