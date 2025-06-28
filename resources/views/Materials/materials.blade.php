@extends('Main.User.mainuser')

@section('title', 'Materiales')

@section('content')
        
<div class="flex justify-end max-w-4xl mx-auto mb-4">

    <form class="flex items-center max-w-sm mx-auto">   
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 ps-10 p-2.5" placeholder="Buscar material... " required />
        </div>
        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    <button 
      id="btn-agregar-material"
      data-modal-target="add-modal" 
      data-modal-toggle="add-modal" 
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
      type="button">Agregar Material</button>

</div>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-4xl mx-auto">
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3">Material</th>
          <th scope="col" class="px-6 py-3">Descripción</th>
          <th scope="col" class="px-6 py-3">Stock</th>
          <th scope="col" class="px-6 py-3">UNID/MED</th>
          <th scope="col" class="px-6 py-3"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($materials as $material)
          <tr class="bg-white border-b hover:bg-gray-50">
            <td class="px-6 py-3 font-semibold text-gray-900">{{ $material->nombre }}</td>
            <td class="px-6 py-3">{{ $material->descripcion }}</td>
            <td class="px-6 py-3">{{ $material->stock }}</td>
            <td class="px-6 py-3">{{ $material->unidad_medida }}</td>
            <td class="px-6 py-3">
              <button 
                data-modal-target="edit-modal"
                data-modal-toggle="edit-modal"
                class="font-medium text-blue-600 hover:underline editar-material"
                data-id="{{ $material->id }}"
                data-nombre="{{ $material->nombre }}"
                data-descripcion="{{ $material->descripcion }}"
                data-stock="{{ $material->stock }}"
                data-unidad="{{ $material->unidad_medida }}"
              >Editar</button>
            </td>
          </tr>
        @endforeach
      </tbody>
      
    </table>
</div>

<!-- Modal para Agregar Material -->
<div id="add-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Agregar Material</h3>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-modal">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Cerrar modal</span>
          </button>
        </div>
        <!-- Formulario para agregar material -->
        <form id="agregar-material-form" class="p-4 md:p-5" method="POST">
            @csrf  <!-- Asegúrate de agregar este campo CSRF -->

            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre del material</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Nombre del material" required>
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                    <input type="number" name="stock" id="stock" value="0" readonly class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed" placeholder="0" required>
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label for="unit" class="block mb-2 text-sm font-medium text-gray-900">UNID/MED</label>
                    <input type="text" name="unit" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Caja, Unidad, Paquete" required>
                </div>

                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descripción del material</label>
                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Escribe la descripción aquí" required></textarea>
                </div>
            </div>

            <div class="flex justify-between">
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Guardar cambios
                </button>
            </div>
        </form>

      </div>
    </div>
</div>


<!-- Modal para Editar Material -->
<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Editar Material</h3>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Cerrar modal</span>
          </button>
        </div>
        <form class="p-4 md:p-5">
          <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre del material</label>
              <input type="text" name="edit-name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Nombre del material" required>
            </div>
  
            <div class="col-span-2 sm:col-span-1">
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                <input type="number" name="edit-stock" id="edit-stock" value="0" readonly class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed" placeholder="0">
              </div>
              
  
            <div class="col-span-2 sm:col-span-1">
              <label for="unit" class="block mb-2 text-sm font-medium text-gray-900">UNID/MED</label>
              <input type="text" name="edit-unit" id="edit-unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Caja, Unidad, Paquete" required>
            </div>
  
            <div class="col-span-2">
              <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descripción del material</label>
              <textarea id="edit-description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Escribe la descripción aquí"></textarea>
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

<script>
    let materialId = null;

    document.querySelectorAll('.editar-material').forEach(boton => {
        boton.addEventListener('click', () => {
            materialId = boton.dataset.id;  // Guardar ID del material
            document.getElementById('edit-name').value = boton.dataset.nombre;
            document.getElementById('edit-description').value = boton.dataset.descripcion;
            document.getElementById('edit-unit').value = boton.dataset.unidad;
            document.getElementById('edit-stock').value = boton.dataset.stock;

            document.getElementById('btn-eliminar').classList.remove('hidden');
            document.getElementById('modal-title').textContent = 'Editar Material';
        });
    });
    
</script>

<script>
    document.getElementById('agregar-material-form').addEventListener('submit', function (e) {
        e.preventDefault();  // Prevenir comportamiento por defecto

        const formData = new FormData(this);

        fetch('{{ route('material.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Material agregado exitosamente.');

                // Cerrar correctamente el modal con Flowbite (quita overlay)
                const modalElement = document.getElementById('add-modal');
                const modalInstance = new Modal(modalElement);
                modalInstance.hide();

                // Limpiar el formulario
                document.getElementById('agregar-material-form').reset();

                // Agregar el material a la tabla
                const tableBody = document.querySelector('tbody');
                const newRow = document.createElement('tr');
                newRow.classList.add('bg-white', 'border-b', 'hover:bg-gray-50');
                newRow.innerHTML = `
                    <td class="px-6 py-3 font-semibold text-gray-900">${data.material.nombre}</td>
                    <td class="px-6 py-3">${data.material.descripcion}</td>
                    <td class="px-6 py-3">${data.material.stock}</td>
                    <td class="px-6 py-3">${data.material.unidad_medida}</td>
                    <td class="px-6 py-3">
                        <button 
                            data-modal-target="edit-modal"
                            data-modal-toggle="edit-modal"
                            class="font-medium text-blue-600 hover:underline editar-material"
                            data-id="${data.material.id}"
                            data-nombre="${data.material.nombre}"
                            data-descripcion="${data.material.descripcion}"
                            data-stock="${data.material.stock}"
                            data-unidad="${data.material.unidad_medida}"
                        >Editar</button>
                    </td>
                `;
                tableBody.appendChild(newRow);
            } else {
                alert('Hubo un error al agregar el material.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al procesar la solicitud.');
        });
    });
</script>

<script>
  document.getElementById('btn-eliminar').addEventListener('click', () => {
      if (!materialId) return;

      if (!confirm('¿Estás seguro de que deseas eliminar este material?')) return;

      fetch(`/admin/materiales/${materialId}`, {
          method: 'DELETE',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Accept': 'application/json'
          }
      })
      .then(response => {
          if (response.ok) {
              alert('Material eliminado correctamente.');

              // Ocultar el modal (si usas Flowbite o simplemente quitando la clase "hidden")
              const modalElement = document.getElementById('edit-modal');
              const modalInstance = new Modal(modalElement);
              modalInstance.hide();

              // Eliminar la fila correspondiente de la tabla
              const row = document.querySelector(`button[data-id="${materialId}"]`).closest('tr');
              row.remove();

              // Resetear ID
              materialId = null;
          } else {
              alert('Error al eliminar el material.');
          }
      })
      .catch(error => {
          console.error('Error al eliminar:', error);
          alert('Ocurrió un error al eliminar el material.');
      });
  });



</script>

<script>
    document.getElementById('btn_editar').addEventListener('click', function(event) {
    event.preventDefault();

    // Captura los valores del formulario
    const name = document.getElementById('edit-name').value;
    const stock = document.getElementById('edit-stock').value;
    const unit = document.getElementById('edit-unit').value;
    const description = document.getElementById('edit-description').value;

    // Hacer la solicitud a Laravel con fetch
    fetch(`/admin/materiales/${materialId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            name,
            stock,
            unit,
            description
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Material actualizado correctamente');

            // Recargar la página para reflejar los cambios
            location.reload();
        } else {
            alert('Hubo un problema al guardar los cambios');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
    });
});

</script>

@endsection
