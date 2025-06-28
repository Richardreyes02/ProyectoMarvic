@extends('Main.User.mainuser')

@section('title', 'Detalle de Producto')

@section('content')
<div class="container mx-auto py-8">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Producto #{{ $product->id }}</h2>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver al listado</a>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-2">
      <p><strong>Nombre:</strong> {{ $product->nombre }}</p>
      <p><strong>SKU:</strong> {{ $product->sku }}</p>
      <p><strong>Precio:</strong> S/ {{ number_format($product->precio, 2) }}</p>
      <p><strong>Cantidad:</strong> {{ $product->cantidad }}</p>
      {{-- Ejemplo de otros datos: --}}
      <p><strong>Creado:</strong>
        {{ optional($product->created_at)->format('d/m/Y H:i') ?? 'Sin fecha' }}
      </p>   <p><strong>Actualizado:</strong>
        {{ optional($product->updated_at)->format('d/m/Y H:i') ?? 'Sin fecha' }}
      </p>    
    </div>
    <div class="text-center">
      @if($product->imagen)
        <img src="{{ asset('storage/'.$product->imagen) }}"
             alt="Imagen de {{ $product->nombre }}"
             class="mx-auto h-32 object-cover rounded"
        >
      @else
        <p class="text-gray-600">Sin imagen</p>
      @endif
    </div>
  </div>
</div>
@endsection
