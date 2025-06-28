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
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
</div>




@endsection
