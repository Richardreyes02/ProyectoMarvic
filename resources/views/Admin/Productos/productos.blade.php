@extends('Main.User.mainuser')

@section('title', 'Listado de Productos')

@section('content')

<div class="flex justify-end max-w-4xl mx-auto mb-4">

    <!-- Formulario para buscar producto -->
    <form class="flex items-center max-w-sm mx-auto">
        <label for="simple-search" class="sr-only">Buscar</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input type="text" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 ps-10 p-2.5" placeholder="Buscar Producto..." />
        </div>
        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Buscar</span>
        </button>
    </form>

    <!-- Botón para abrir modal para agregar un nuevo producto -->
    <button 
      id="btn-agregar-producto"
      data-modal-target="add-modal" 
      data-modal-toggle="add-modal" 
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ms-4"
      type="button">Agregar Producto</button>

</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-4xl mx-auto">
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3">CÓDIGO</th>
          <th scope="col" class="px-6 py-3">DESCRIPCIÓN</th>
          <th scope="col" class="px-6 py-3">SERIE</th>
          <th scope="col" class="px-6 py-3">CANTIDAD</th>
          <th scope="col" class="px-6 py-3"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr class="bg-white border-b hover:bg-gray-50">
            <td class="px-6 py-3 font-semibold text-gray-900">{{ $product->codigo }}</td>
            <td class="px-6 py-3">{{ $product->descripcion }}</td>
            <td class="px-6 py-3">{{ $product->serie }}</td>
            <td class="px-6 py-3">{{ $product->cantidad }}</td>
            <td class="px-6 py-3">
              <button 
                data-modal-target="edit-modal"
                data-modal-toggle="edit-modal"
                class="font-medium text-blue-600 hover:underline editar-producto"
                data-id="{{ $product->id }}"
                data-codigo="{{ $product->codigo }}"
                data-descripcion="{{ $product->descripcion }}"
                data-serie="{{ $product->serie }}"
                data-cantidad="{{ $product->cantidad }}"
              >Editar</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
</div>

<!-- Modal para Agregar Producto -->
<div id="add-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-md max-h-full">
    <div class="relative bg-white rounded-lg shadow">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
        <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Agregar Producto</h3>
        <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                data-modal-toggle="add-modal">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Cerrar modal</span>
        </button>
      </div>

      <form id="agregar-producto-form" class="p-4 md:p-5" method="POST" action="{{ route('products.store') }}">
        @csrf

        <div class="grid gap-4 mb-4 grid-cols-2">
          <div class="col-span-2">
            <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900">Código</label>
            <input type="text" name="codigo" id="codigo"
                   class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                   placeholder="Código del Producto" required>
          </div>

          <div class="col-span-2">
            <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900">Selecciona el tipo:</label>
            <select id="tipo"
                    class="bg-white border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
              <option value="" disabled selected>Seleccione un tipo</option>
              <option value="SANDALIAS">Sandalias</option>
              <option value="BOTINES">Botines</option>
            </select>
          </div>

          <div class="col-span-2">
            <label for="color" class="block mb-2 text-sm font-medium text-gray-900">Color</label>
            <input type="text" id="color"
                   class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                   placeholder="Color del Producto" required>
          </div>

          <div class="col-span-2">
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-500">Descripción del Producto</label>
            <input type="hidden" name="descripcion" id="descripcion-hidden" class="resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-600 focus:border-blue-600"
                    placeholder="Descripción del Producto">
          </div>

          <div class="col-span-2">
            <label for="serie" class="block mb-2 text-sm font-medium text-gray-900">Selecciona la Serie:</label>
            <select name="serie" id="serie"
                    class="bg-white border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
              <option value="" disabled selected>Seleccione una serie</option>
              <option value="5-9">5-9</option>
              <option value="5-8">5-8</option>
            </select>
          </div>

          <div class="col-span-2 sm:col-span-1">
            <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-900">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" value="0"
                   class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5"
                   placeholder="0" min="0" required>
          </div>
        </div>

        <div class="flex justify-between">
          <button type="submit"
                  onclick="generarDescripcion()"
                  class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z"
                    clip-rule="evenodd"></path>
            </svg>
            Guardar Producto
          </button>
          <button type="button"
                  data-modal-toggle="add-modal"
                  class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5">
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal para Editar Producto -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-md max-h-full">
    <div class="relative bg-white rounded-lg shadow">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
        <h3 id="edit-modal-title" class="text-lg font-semibold text-gray-900">Editar Producto</h3>
        <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                data-modal-toggle="edit-modal">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Cerrar modal</span>
        </button>
      </div>

      <form class="p-4 md:p-5">
        <div class="grid gap-4 mb-4 grid-cols-2">
          <div class="col-span-2">
            <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900">Código</label>
            <input type="text" name="edit-codigo" id="edit-codigo"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                   placeholder="Código del Producto" required>
          </div>

          <div class="col-span-2">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descripción del Producto</label>
            <textarea name="edit-description" id="edit-description" rows="3"
                      class="resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-600 focus:border-blue-600"
                      placeholder="Descripción del Producto"></textarea>
          </div>

          <div class="col-span-2">
            <label for="serie" class="block mb-2 text-sm font-medium text-gray-900">Selecciona la Serie:</label>
            <select name="edit-serie" id="edit-serie"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
              <option value="" disabled>Seleccione una serie</option>
              <option value="5-9">5-9</option>
              <option value="5-8">5-8</option>
            </select>
          </div>

          <div class="col-span-2 sm:col-span-1">
            <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-900">Cantidad</label>
            <input type="number" name="edit-cantidad" id="edit-cantidad" min="0"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                   placeholder="0" required>
          </div>
        </div>

        <div class="flex justify-between">
            <button type="submit" id="btn_editar" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
              </svg>
              Guardar cambios
            </button>
            <button type="button" id="btn-eliminar" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Eliminar material
            </button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Script para cargar datos al modal de edición -->
<script>
    let productoId = null;

    document.querySelectorAll('.editar-producto').forEach(boton => {
        boton.addEventListener('click', () => {
            productoId = boton.dataset.id;  // Guardar ID del material
            document.getElementById('edit-codigo').value = boton.dataset.codigo;
            document.getElementById('edit-description').value = boton.dataset.descripcion;
            document.getElementById('edit-serie').value = boton.dataset.serie;
            document.getElementById('edit-cantidad').value = boton.dataset.cantidad;

            document.getElementById('btn-eliminar').classList.remove('hidden');
            document.getElementById('modal-title').textContent = 'Editar Material';
        });
    });
    
</script>

<script>
    document.getElementById('agregar-producto-form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevenir envío por defecto

        const formData = new FormData(this);

        fetch('{{ route('products.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Producto agregado exitosamente.');

                // Cerrar modal con Flowbite
                const modalElement = document.getElementById('add-modal');
                const modalInstance = new Modal(modalElement);
                modalInstance.hide();

                // Limpiar formulario
                this.reset();

                // Agregar nueva fila a la tabla
                const tableBody = document.querySelector('tbody');
                const newRow = document.createElement('tr');
                newRow.classList.add('bg-white', 'border-b', 'hover:bg-gray-50');
                newRow.innerHTML = `
                    <td class="px-6 py-3 font-semibold text-gray-900">${data.product.codigo}</td>
                    <td class="px-6 py-3">${data.product.descripcion}</td>
                    <td class="px-6 py-3">${data.product.serie}</td>
                    <td class="px-6 py-3">${data.product.cantidad}</td>
                    <td class="px-6 py-3">
                        <button 
                            data-modal-target="edit-modal"
                            data-modal-toggle="edit-modal"
                            class="font-medium text-blue-600 hover:underline editar-producto"
                            data-id="${data.product.id}"
                            data-codigo="${data.product.codigo}"
                            data-descripcion="${data.product.descripcion}"
                            data-serie="${data.product.serie}"
                            data-cantidad="${data.product.cantidad}"
                        >Editar</button>
                    </td>
                `;
                tableBody.appendChild(newRow);

                // Volver a agregar event listener al nuevo botón "Editar"
                newRow.querySelector('.editar-producto').addEventListener('click', function () {
                    document.querySelector('#edit-id').value = data.product.id;
                    document.querySelector('#edit-codigo').value = data.product.codigo;
                    document.querySelector('#edit-descripcion').value = data.product.descripcion;
                    document.querySelector('#edit-serie').value = data.product.serie;
                    document.querySelector('#edit-cantidad').value = data.product.cantidad;
                    document.getElementById('editar-producto-form').action = `/admin/products/${data.product.id}`;
                });

            } else {
                alert(data.message || 'Hubo un error al agregar el producto.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al procesar la solicitud.');
        });
    });
</script>

<script>
function generarDescripcion() {
  const codigo = document.getElementById('codigo').value.trim();
  const tipo   = document.getElementById('tipo').value.trim().toUpperCase();
  const color  = document.getElementById('color').value.trim().toUpperCase();
  const serie  = document.getElementById('serie').value.trim();

  if (!codigo || !tipo || !color || !serie) {
    alert('Todos los campos son obligatorios para generar la descripción.');
    event.preventDefault();
    return;
  }

  const descripcion = `${codigo}_${tipo}_${color}_${serie}`;
  document.getElementById('descripcion-hidden').value = descripcion;
}
</script>

 


@endsection
