<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar sesión</title>
  @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwind, Flowbite, Alpine.js --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 3000)" class="bg-gray-100 min-h-screen">

  <!-- Preloader centrado -->
  <div 
    x-show="loading"
    x-transition.opacity.duration.700ms
    class="fixed inset-0 z-50 flex items-center justify-center bg-white"
  >
    <div class="text-center">
      <img src="{{ asset('images/marviclogo.png') }}" alt="Logo" class="w-96 max-w-full mx-auto mb-4 animate-pulse" />
      <p class="text-gray-500 text-sm">Cargando, por favor espera...</p>
    </div>
  </div>

  <!-- Login Form -->
  <div 
    x-show="!loading" 
    x-transition.opacity.duration.700ms 
    class="flex items-center justify-center min-h-screen px-4"
  >
    <div class="w-full max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <form class="space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <h5 class="text-xl font-medium text-gray-900">Iniciar sesión en la plataforma</h5>

        <div>
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</label>
          <input 
            type="email" 
            name="email" 
            id="email" 
            class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
            placeholder="tucorreo@empresa.com" 
            required 
          />
        </div>

        <div>
          <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Contraseña</label>
          <input 
            type="password" 
            name="password" 
            id="password" 
            placeholder="••••••••" 
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
            required 
          />
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input 
              id="remember" 
              type="checkbox" 
              class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-blue-300 text-blue-600"
            />
            <label for="remember" class="ml-2 text-sm font-medium text-gray-900">Recuérdame</label>
          </div>
          <a href="#" class="text-sm text-blue-700 hover:underline">¿Olvidaste tu contraseña?</a>
        </div>

        <button 
          type="submit" 
          class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        >
          Iniciar sesión
        </button>
      </form>

      @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm mt-4 mb-4" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm mb-4" role="alert">
            <strong class="font-bold">¡Atención!</strong>
            <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
        @endif

    </div>
    
  </div>

</body>
</html>
