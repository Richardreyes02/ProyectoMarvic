@extends('Main.User.mainuser')

@section('title', 'Home Usuario')

@section('content')

<div class="p-6 bg-gray-100">
  <!-- Mensaje de bienvenida -->
  <div class="mb-6 pt-6">
    <h1 class="text-2xl text-gray-700">
      Hola de nuevo,
      <span class="font-bold text-3xl text-gray-900">
        {{ $user->name ?? 'Usuario' }}
      </span>
    </h1>
  </div>
  <div class="mb-10">
    <h1 class="text-2xl text-gray-700">
      Elige que quieres hacer hoy,
    </h1>
  </div>

  <!-- Grid de Cards -->
  <div class="flex justify-center">
    <div class="grid grid-cols-2 gap-4">
        <!-- Card Materiales -->
        <a href="{{ route('user.materiales.index') }}">
        <div class="group bg-white shadow-md rounded-xl p-4 w-72 h-[280px] flex flex-col items-center justify-center text-center gap-4 transition duration-300 ease-in-out hover:bg-gray-800 hover:text-gray-100 hover:shadow-lg">
            <div class="w-32 h-32 bg-blue-100 rounded-full flex items-center justify-center transition group-hover:bg-gray-100">
            <svg class="w-16 h-16 text-blue-800 transition duration-300 group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 19h4m6 0h4m-6.9627-4.3843V8.63418L17 5.93918m-4.9298 2.66213L7.04175 5.93919M12 2.99719l5.033 2.90583v5.81168L12 14.6205l-5.03303-2.9058V5.90302L12 2.99719ZM14 19c0 1.1045-.8954 2-2 2s-2-.8955-2-2c0-1.1046.8954-2 2-2s2 .8954 2 2Z"/>
            </svg>
            </div>
            <p class="mt-6 text-base uppercase font-[Poppins] font-bold text-gray-700 tracking-wide transition group-hover:text-gray-100">Materiales</p>
        </div>
        </a>

        <!-- Card Productos -->
        <a href="{{ route('user.products.index') }}">
        <div class="group bg-white shadow-md rounded-xl p-4 w-72 h-[280px] flex flex-col items-center justify-center text-center gap-4 transition duration-300 ease-in-out hover:bg-gray-800 hover:text-gray-100 hover:shadow-lg">
            <div class="w-32 h-32 bg-green-100 rounded-full flex items-center justify-center transition group-hover:bg-gray-100">
            <svg class="w-16 h-16 text-green-800 transition duration-300 group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
            </svg>
            </div>
            <p class="mt-6 text-base uppercase font-[Poppins] font-bold text-gray-700 tracking-wide transition group-hover:text-gray-100">Productos</p>
        </div>
        </a>
  </div>
  </div>
  
</div>

@endsection
