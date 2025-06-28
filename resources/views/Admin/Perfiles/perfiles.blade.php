@extends('Admin.Main.main')  
@section('title', 'Pruebas')  
@section('content')  


<!-- Modal Fondo -->
<div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <!-- Modal contenido -->
  <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 mx-4 overflow-auto max-h-[90vh]">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-semibold text-gray-900">Agregar Usuario</h3>
      <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700 focus:outline-none text-2xl font-bold">&times;</button>
    </div>

    <!-- Formulario -->
    <form action="{{ route('perfiles.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf     
         <!-- Email -->
      <div class="relative z-0 w-full mb-5 group">
        <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
      </div>

      <!-- Contraseña -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
        </div>

        <!-- Confirmar contraseña -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password_confirmation" id="password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="password_confirmation" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar Contraseña</label>
        </div>


      <!-- Nombre + Apellidos -->
      <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="first_name" id="first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="last_name" id="last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-6">Apellidos</label>
        </div>
      </div>

      <!-- DNI + Teléfono -->
      <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="dni" id="dni" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="dni" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-6">DNI</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="tel" name="phone" id="phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="phone" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
        </div>
      </div>

      <!-- Género + Rol -->
      <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Género</label>
          <select id="gender" name="gender" required class="bg-transparent border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-600 block w-full p-2.5">
            <option value="" disabled selected>Selecciona</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
          </select>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
            <select id="cargo" name="cargo" required class="...">
                <option value="" disabled selected>Seleccione un cargo</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

        </div>

      </div>

      <!-- Botón -->
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Guardar</button>
    </form>
  </div>
</div>



<div class="grid grid-cols-4 md:grid-cols-4 gap-4"> 

    <!-- Cuadro para Agregar Usuario -->
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm flex flex-col items-center justify-center py-10">
        <button id="addUserModalButton" class="flex flex-col items-center justify-center w-24 h-24 mb-3 rounded-full bg-green-600 hover:bg-green-700 text-white text-lg font-semibold focus:outline-none focus:ring-4 focus:ring-green-300">
            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </button>
        <h5 class="text-xl font-medium text-gray-900">Agregar Usuario</h5>
    </div>

    @foreach ($users as $user)         
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">             
            <div class="flex justify-end px-4 pt-4 relative">                 
                <button id="dropdownButton-{{ $user->id }}" data-dropdown-toggle="dropdown-{{ $user->id }}" class="inline-block text-gray-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm p-1.5" type="button">                     
                    <span class="sr-only">Open dropdown</span>                     
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">                         
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>                     
                    </svg>                 
                </button>                  
                <!-- Dropdown -->                 
                <div id="dropdown-{{ $user->id }}" class="z-10 hidden absolute right-0 mt-2 w-44 bg-white border border-gray-100 rounded-lg shadow-sm">                     
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownButton-{{ $user->id }}">                         
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Editar</a></li>                         
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Exportar movimientos</a></li>                         
                        <li><a href="#" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Delete</a></li>                     
                    </ul>                 
                </div>             
            </div>              
            <div class="flex flex-col items-center pb-10">                 
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/images/Perfil/perfil.jpg" alt="{{ $user->name }}" />                 
                <h5 class="mb-1 text-xl font-medium text-gray-900">{{ $user->name }}</h5>                 
                <span class="text-sm text-gray-500">{{ $user->cargo }}</span>                 
                <div class="flex mt-4 md:mt-6">                     
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Ver Movimientos</a>                     
                    <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-500 hover:text-white focus:ring-4 focus:ring-gray-100">Eliminar</a>                 
                </div>             
            </div>         
        </div>     
    @endforeach 

</div>  




<script>
  document.addEventListener('DOMContentLoaded', () => {
    const openModalBtn = document.querySelector('#addUserModalButton');
    const modal = document.getElementById('addUserModal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    openModalBtn.addEventListener('click', () => {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    });

    closeModalBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    });

    // Cerrar modal si se hace clic fuera del contenido
    modal.addEventListener('click', (e) => {
      if(e.target === modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#addUserModal form');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(form);

      const data = Object.fromEntries(formData.entries());

      try {
        const response = await fetch("{{ route('perfiles.store') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
          },
          body: formData
        });

        if (!response.ok) {
          const errorData = await response.json();
          console.error('Errores:', errorData);
          alert('Hubo un error al guardar. Revisa los datos.');
          return;
        }

        const result = await response.json();
        alert('Usuario guardado correctamente');
        location.reload(); // recarga para actualizar la vista
      } catch (error) {
        console.error('Error al enviar:', error);
        alert('Ocurrió un error inesperado');
      }
    });
  });
</script>


@endsection