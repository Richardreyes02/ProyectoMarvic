@extends('Main.User.mainuser')

@section('title', 'Listado de Productos')


@vite([
  'resources/css/app.css',
  'resources/css/custom/producto.css',
  'resources/js/app.js',
  'resources/js/custom/producto.js',
])

@section('content')
<div class="container mx-auto py-8">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Productos</h2>
   {{-- BOTÓN NUEVO PRODUCTO --------------------------------------------------}}
<a href="{{ route('productos.create') }}" class="btn-nuevo">
  <i class="fa-solid fa-plus me-1"></i> Nuevo
</a>

    </div>

  @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
  @endif

  @if($products->count())
    <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left">ID</th>
          <th class="px-4 py-2 text-left">Nombre</th>
          <th class="px-4 py-2 text-left">SKU</th>
          <th class="px-4 py-2 text-right">Precio</th>
          <th class="px-4 py-2 text-right">Cantidad</th>
          <th class="px-4 py-2 text-center">Imagen</th>
          <th class="px-4 py-2 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $product->id }}</td>
          <td class="px-4 py-2">{{ $product->nombre }}</td>
          <td class="px-4 py-2">{{ $product->sku }}</td>
          <td class="px-4 py-2 text-right">{{ number_format($product->precio, 2) }}</td>
          <td class="px-4 py-2 text-right">{{ $product->cantidad }}</td>
          <td class="px-4 py-2 text-center">
            @if($product->imagen)
              <img src="{{ asset('storage/'.$product->imagen) }}" alt="Imagen" class="h-12 mx-auto">
            @else
              —
            @endif
          </td>
          {{-- ACCIONES DENTRO DE LA TABLA ------------------------------------------}}
          <td class="px-4 py-2 text-center space-x-1">
            {{-- Ver --}}
            <a href="{{ route('productos.show', $product) }}" class="btn-accion btn-ver" title="Ver">
                <i class="fa-solid fa-eye"></i>
            </a>

            {{-- Editar --}}
            <a href="{{ route('productos.edit', $product) }}" class="btn-accion btn-editar" title="Editar">
                <i class="fa-solid fa-pen"></i>
            </a>

            {{-- Eliminar --}}
            <form action="{{ route('productos.destroy', $product) }}" method="POST"
                  class="inline-block"
                  onsubmit="return confirm('¿Eliminar este producto?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-accion btn-eliminar" title="Eliminar">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-4">
      {{ $products->links() }}
    </div>
  @else
    <p class="text-gray-600">No hay productos registrados.</p>
  @endif
</div>
@endsection
