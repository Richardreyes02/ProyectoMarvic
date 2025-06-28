@extends('Main.User.mainuser')

@section('title', 'Editar Producto')

@section('content')
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-6">Editar Producto #{{ $product->id }}</h2>

  @if($errors->any())
    <div class="alert alert-danger mb-4">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('productos.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $product->nombre) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
        <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $product->precio) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $product->cantidad) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div class="md:col-span-2">
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
        @if($product->imagen)
          <div class="mb-2">
            <img src="{{ asset('storage/'.$product->imagen) }}" alt="" class="h-16">
          </div>
        @endif
        <input type="file" name="imagen" id="imagen" class="mt-1 block w-full text-gray-700">
      </div>
    </div>
    <div class="mt-6 flex justify-end space-x-3">
      <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
      <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
  </form>
</div>
@endsection
