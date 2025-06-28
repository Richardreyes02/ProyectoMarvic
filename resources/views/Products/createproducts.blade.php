@extends('Main.User.mainuser')

@section('title', 'Registrar Producto')

@section('content')
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-6">Registrar Nuevo Producto</h2>

  @if($errors->any())
    <div class="alert alert-danger mb-4">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form id="form-producto" action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
        <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
        <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div class="md:col-span-2">
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
        <input type="file" name="imagen" id="imagen" class="mt-1 block w-full text-gray-700">
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <!-- Cancelar -->
        <a href="{{ route('productos.index') }}"
           class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-none transition focus:outline-none focus:ring-2 focus:ring-gray-400"
        >
          Cancelar
        </a>
      
        <!-- Guardar -->
        <button type="submit"
                class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-none transition focus:outline-none focus:ring-2 focus:ring-green-400"
                id="btn-submit"
        >
          Guardar
        </button>
      </div>
      
  </form>
</div>
@endsection
