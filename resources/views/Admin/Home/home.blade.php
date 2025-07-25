@extends('Admin.Main.main')

@section('title', 'Home Administrador')

@section('content')

<div class="p-6 bg-gray-100">
  <!-- Mensaje de bienvenida -->
  <div class="mb-10 pt-6">
    <h1 class="text-2xl text-gray-700">
      Hola de nuevo,
      <span class="font-bold text-3xl text-gray-900">
        {{ $user->name ?? 'Administrador' }}
      </span>
    </h1>
  </div>
  <div class="mb-6">
    <h1 class="text-2xl text-gray-700">
      Elige que quieres hacer hoy,
    </h1>
  </div>

  <!-- Grid de Cards -->
  <div class="grid grid-cols-4 gap-4">

    <!-- Card 1 -->
    <a href="{{ route('materiales.index') }}">
      <div class="group bg-white shadow-md rounded-xl p-4 aspect-[3/4] flex flex-col items-center justify-center text-center gap-4 transition duration-300 ease-in-out hover:bg-gray-800 hover:text-gray-100 hover:shadow-lg">
        <div class="w-32 h-32 bg-blue-100 rounded-full flex items-center justify-center transition group-hover:bg-gray-100">
          <svg class="w-16 h-16 text-blue-800 transition duration-300 group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 19h4m6 0h4m-6.9627-4.3843V8.63418L17 5.93918m-4.9298 2.66213L7.04175 5.93919M12 2.99719l5.033 2.90583v5.81168L12 14.6205l-5.03303-2.9058V5.90302L12 2.99719ZM14 19c0 1.1045-.8954 2-2 2s-2-.8955-2-2c0-1.1046.8954-2 2-2s2 .8954 2 2Z"/>
          </svg>
        </div>
        <p class="mt-6 text-base uppercase font-[Poppins] font-bold text-gray-700 tracking-wide transition group-hover:text-gray-100">Materiales</p>
      </div>
    </a>

    <!-- Card 2 -->
    <a href="{{ route('products.index') }}">
      <div class="group bg-white shadow-md rounded-xl p-4 aspect-[3/4] flex flex-col items-center justify-center text-center gap-4 transition duration-300 ease-in-out hover:bg-gray-800 hover:text-gray-100 hover:shadow-lg">
        <div class="w-32 h-32 bg-green-100 rounded-full flex items-center justify-center transition group-hover:bg-gray-100">
          <svg class="w-16 h-16 text-green-800 transition duration-300 group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
          </svg>
        </div>
        <p class="mt-6 text-base uppercase font-[Poppins] font-bold text-gray-700 tracking-wide transition group-hover:text-gray-100">Productos</p>
      </div>
    </a>
    

    <!-- Card 3 -->
    <a href="{{ route('reportes.index') }}">
      <div class="group bg-white shadow-md rounded-xl p-4 aspect-[3/4] flex flex-col items-center justify-center text-center gap-4 transition duration-300 ease-in-out hover:bg-gray-800 hover:text-gray-100 hover:shadow-lg">
        <div class="w-32 h-32 bg-yellow-100 rounded-full flex items-center justify-center transition group-hover:bg-gray-100">
          <svg class="w-16 h-16 text-yellow-800 transition duration-300 group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15v4m6-6v6m6-4v4m6-6v6M3 11l6-5 6 5 5.5-5.5"/>
          </svg>
        </div>
        <p class="mt-6 text-base uppercase font-[Poppins] font-bold text-gray-700 tracking-wide transition group-hover:text-gray-100">Reportes</p>
      </div>
    </a>
    

    <!-- Card 4 -->
    <div class="group bg-white shadow-md rounded-xl p-4 aspect-[3/4] flex flex-col items-center justify-center text-center gap-4 transition duration-300 ease-in-out hover:bg-gray-800 hover:text-gray-100 hover:shadow-lg">
      <div class="w-32 h-32 bg-red-100 rounded-full flex items-center justify-center transition group-hover:bg-gray-100">
        <svg class="w-16 h-16 text-red-800 transition duration-300 group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20V7m0 13-4-4m4 4 4-4m4-12v13m0-13 4 4m-4-4-4 4"/>
        </svg>
      </div>
      <p class="mt-6 text-base uppercase font-[Poppins] font-bold text-gray-700 tracking-wide transition group-hover:text-gray-100">CalziAI</p>
    </div>

  </div>


  
</div>

@endsection
